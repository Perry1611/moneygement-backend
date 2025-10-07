<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function detail(request $request){
        $post = Post::find($request->id);
        return view('dashboard.details', [
            'title' => 'Detail',
            'post' => $post,
        ]);
    }

    public function dashboard(){
        $totalcost = Post::where('user_id', auth()->user()->id)->sum('cost');
        $totalincome = User::where('id', auth()->user()->id)->sum('income');
        $totalAmount = $totalincome - $totalcost;
        $categories = Category::all();
        return view('dashboard.dashboard', [
            'title' => 'Dashboard',
            'posts' => Post::where('user_id', auth()->user()->id)->paginate(5),
            'amount' => $totalcost,
            'income' => $totalAmount,
            'categories' => $categories,
        ]);
    }

    public function about(){
        return view('dashboard.about', [
            'title' => 'About',
        ]);
    }

    public function category(Request $request){

        $category = Category::find($request->id);
        $post = Post::where('user_id', auth()->user()->id)->where('category_id', $request->id)->simplePaginate(10);
        return view('dashboard.category', [
            'title' => 'Category',
            'posts' => $post,
            'category' => $category,
        ]);
    }

}
