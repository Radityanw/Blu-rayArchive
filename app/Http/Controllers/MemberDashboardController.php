<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index()
    {
        
    
        // Fetch rentals with user and bluray relationships
        $rentals = Rental::where('user_id', Auth::id())->with('bluray')->get();

    return view('memberdashboard', compact('rentals'));
    }
    }

