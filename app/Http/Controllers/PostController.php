<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
class PostController extends Controller
{
    public function delete(request $request)
    {
        Post::where('id', $request->id)->delete();
        return redirect('/dashboard')->with('error', 'Post has been deleted successfully!');
    }

    public function create()
    {
        return view('CRUD.create',[
            'title' => 'Add new Post',
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' =>'required|min:5|max:255',
            'body' =>'required|min:5',
            'category_id' =>'required',
            'cost' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        Post::create($validatedData);

        return redirect('/dashboard')->with('success', 'New post has been added successfully!');
    }

    public function edit(Request $request)
    {
        $post = Post::find($request->id);

        return view('CRUD.edit',[
            'title' => 'Edit post',
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'title' =>'required|min:5|max:255',
            'body' =>'required|min:5',
            'category_id' =>'required',
            'cost' =>'required'
        ]);

        Post::where('id', $request->id)->update($validatedData);

        return redirect('/dashboard')->with('success', 'Post has been updated successfully!');
    }

    public function income(){
        return view('dashboard.income', [
            'title' => 'Add Income',
        ]);
    }

    public function storeIncome(Request $request){
        $user = User::find($request->id);
        $totalamount = $user->income;
        $totalinput = $request->income;

        $sumAmount = $totalinput + $totalamount;
        User::where('id', $request->id)->update(['income' => $sumAmount]);

        return redirect('/dashboard')->with('success', 'Income has been added successfully!');
    }

    public function incomeEdit(){
        $old_amount = User::find(Auth()->user()->id);
        return view('dashboard.incomeEdit', [
            'title' => 'Edit Income',
            'old_amount' => $old_amount->income,
        ]);
    }

    public function editIncome(Request $request){
        $data =  $request->income;
        User::where('id', $request->id)->update(['income' => $data]);

        return redirect('/dashboard')->with('success', 'Income has been updated successfully!');
    }

    public function doneCost(Request $request){
        $totalcost = Post::where('user_id', auth()->user()->id)->sum('cost');
        $totalincome = User::where('id', auth()->user()->id)->sum('income');
        $totalAmount = $totalincome - $totalcost;

        User::where('id', $request->id)->update(['income' => $totalAmount]);
        Post::where('user_id', Auth()->user()->id)->delete();

        return redirect('/dashboard')->with('error', 'All cost has been deleted successfully!');
    }
}
