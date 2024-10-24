<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\BluRay;
use App\Models\Category;
use App\Models\User;

class MainpageController extends Controller
{
    public function index()
    {
        // Fetch rentals with user and bluray relationships
        $rentals = Rental::with(['user', 'bluray'])->get();
        $blurays = BluRay::with('categories')->get();
        $categories = Category::all();
        $users = User::all();
      

        // Pass rentals to the view
        return view('mainpage', compact('rentals', 'blurays', 'categories', 'users'));
    }
    public function mainpage()
{
    // Fetch all categories
    $categories = Category::all();

    // Return the mainpage view with the categories data
    return view('mainpage', compact('categories'));
}

}
