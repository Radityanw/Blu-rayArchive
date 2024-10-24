<?php

namespace App\Http\Controllers;

use App\Models\BluRay; // Import your BluRay model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Method to show Blu-rays by category
    public function showCategory($categoryName)
    {
        // Fetch Blu-rays based on the selected category
        $bluRays = BluRay::whereHas('categories', function ($query) use ($categoryName) {
            $query->where('name', $categoryName);
        })->get();

        // Pass the category name and the filtered Blu-rays to the view
        return view('all', [
            'categoryName' => $categoryName,
            'bluRays' => $bluRays,
        ]);
    }
}

