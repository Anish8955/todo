<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function front(){
        $totalCategory = Category::where('user_id',Auth::user()->id)->get();
        $categories = Category::with(['tasks' => function($query) {
                                         $query->where('user_id', Auth::user()->id);
                                   }])->where('user_id', Auth::user()->id)->get();
        return view('front.main', compact('totalCategory','categories'));
    }

    public function loginpage(){
        return view('login.login');
    }
}
