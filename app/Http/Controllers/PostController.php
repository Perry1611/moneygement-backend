<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
class PostController extends Controller
{
    public function delete($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found.'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post has been deleted successfully!'
        ]);
    }


    public function store(Request $request)
    {
        // ambil user login
        $user = auth()->user();

        // langsung simpan tanpa validasi Laravel
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'cost' => $request->cost,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'New post has been added successfully!',
            'post' => $post
        ], 201);
    }


    public function edit(Request $request)
    {
        $post = Post::find($request->id);

        // Jika post tidak ditemukan
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found.'
            ], 404);
        }

        // Ambil semua kategori (buat dropdown di Flutter)
        $categories = Category::all();

        // Kembalikan response JSON
        return response()->json([
            'success' => true,
            'message' => 'Post data retrieved successfully.',
            'post' => $post,
            'categories' => $categories
        ], 200);
    }


    public function update(Request $request, $id)
    {
        // Cari post berdasarkan ID
        $post = Post::find($id);

        // Jika tidak ditemukan
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found.'
            ], 404);
        }

        // Validasi input (hanya required)
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'cost' => 'required'
        ]);

        // Update data post
        $post->update($validatedData);

        // Response JSON sukses
        return response()->json([
            'success' => true,
            'message' => 'Post has been updated successfully!',
            'post' => $post
        ], 200);
    }

    public function storeIncome(Request $request)
    {
        // Ambil user berdasarkan ID
        $user = User::find($request['id']);

        // Kalau user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Hitung income baru
        $totalamount = $user->income;
        $totalinput = $request->income;
        $sumAmount = $totalamount + $totalinput;

        // Update income user
        $user->update(['income' => $sumAmount]);

        // Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Income has been added successfully!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'income_total' => $sumAmount
            ]
        ], 200);
    }


    public function incomeEdit()
    {
        $user = User::find(Auth()->user()->id);
        return response()->json([
            'success' => true,
            'message' => 'Income has been shown!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'income' => $user->income
            ]
        ], 200);
    }

    public function editIncome(Request $request)
    {
        // Cari user berdasarkan ID
        $user = User::find($request['id']);

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        // Update income secara langsung
        $user->update(['income' => $request['income']]);

        // Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Income has been updated successfully!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'new_income' => $request['income']
            ]
        ], 200);
    }


    public function doneCost(Request $request)
    {
        $user = auth()->user();

        // Hitung total cost & income user
        $totalcost = Post::where('user_id', $user->id)->sum('cost');
        $totalincome = $user->income;
        $totalAmount = $totalincome - $totalcost;

        // Update income user dengan sisa saldo
        $user->update(['income' => $totalAmount]);

        // Hapus semua pengeluaran (post)
        Post::where('user_id', $user->id)->delete();

        // Response JSON sukses
        return response()->json([
            'success' => true,
            'message' => 'Cost have been cleared successfully!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'income_after_reset' => $totalAmount
            ]
        ], 200);
    }

}
