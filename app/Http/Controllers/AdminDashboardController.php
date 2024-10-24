<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\BluRay;
use App\Models\Category;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch rentals with user and bluray relationships
        $rentals = Rental::with(['user', 'bluray'])->get();
        $blurays = BluRay::with('categories')->get();
        $categories = Category::all();
        $users = User::all();
      

        // Pass rentals to the view
        return view('admindashboard', compact('rentals', 'blurays', 'categories', 'users'));
    }


}