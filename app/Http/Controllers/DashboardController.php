<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function detail($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Post retrieved successfully.',
            'post' => $post
        ]);
    }

    public function dashboard(Request $request)
    {
        try {
            $user = $request->user(); // user dari token (Sanctum)

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }

            // Hitung total cost dan income user
            $totalcost = Post::where('user_id', $user->id)->sum('cost');
            $totalincome = $user->income; // langsung ambil dari model user
            $totalAmount = $totalincome - $totalcost;

            // Ambil data post dan kategori
            $posts = Post::where('user_id', $user->id)->get();
            $categories = Category::all();

            // Kirim data ke Flutter
            return response()->json([
                'success' => true,
                'message' => 'Dashboard data retrieved successfully',
                'data' => [
                    'total_cost' => $totalcost,
                    'total_income' => $totalincome,
                    'balance' => $totalAmount,
                    'posts' => $posts,
                    'categories' => $categories
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function category(Request $request)
    {
        // ambil user login
        $user = auth()->user();

        // cari kategori berdasarkan ID yang dikirim
        $category = Category::find($request->id);

        // kalau kategori tidak ditemukan
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        // ambil semua postingan berdasarkan kategori & user
        $posts = Post::where('user_id', $user->id)
            ->where('category_id', $request->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // kalau belum ada postingan di kategori itu
        if ($posts->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'No posts found for this category.',
                'category' => $category,
                'posts' => []
            ]);
        }

        // jika ditemukan, kirim response JSON
        return response()->json([
            'success' => true,
            'message' => 'Posts retrieved successfully.',
            'category' => $category,
            'posts' => $posts
        ], 200);
    }


}
