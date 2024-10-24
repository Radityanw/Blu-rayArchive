<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;



    class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        return view('admindashboard', compact('categories'));
    }

   
    public function create()
    {
        return view('categories.create');
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admindashboard')->with('success', 'Category added successfully.');
    }

   
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

   
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admindashboard')->with('success', 'Category updated successfully.');
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admindashboard')->with('success', 'Category deleted successfully.');
    }
}
