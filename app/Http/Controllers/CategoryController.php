<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
     
   
   

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('mainpage')->with('success', 'Category created successfully!');
    }

    public function destroy($id){

      $category=Category::findOrFail($id);
      $category->delete();
      return redirect()->back()->with('success','category deleted successfully');
    }
}
