<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bluray;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF; 

class RentController extends Controller
{
    public function rent(Request $request)
{
    $userId = auth::id();


    $activeRentals = Rental::where('user_id', $userId)
                            ->where('status', 'Rented')
                            ->count();
    if ($activeRentals >= 2) {
            return redirect()->back()->with('error', 'You cannot rent more than 2 Blu-rays at the same time.');
        }

    $bluray_id = $request->input('bluray_id');
    $days = (int) $request->input('days'); 

    $bluray = Bluray::find($bluray_id);


    if ($bluray->status === 'rented') {
        return back()->withErrors(['error' => 'This Blu-ray is already rented.']);
    }


    $bluray->status = 'rented';
    $bluray->save();


    $rented_at = Carbon::now();


    $due_date = $rented_at->addDays($days);  
 
    $rental = new Rental();
    $rental->user_id = Auth::user()->id;  
    $rental->blurays_id = $bluray_id;
    $rental->rented_at = $rented_at;
    $rental->due_date = $due_date;
    $rental->status = 'Rented';
    $rental->fine = 0; 
    $rental->save();
    return back()->with('success', 'Blu-ray rented successfully!');
}
// public function generateRentStatusPDF($rentId)
// {
//     // Fetch the rent details from the database
//     $rent = Rental::find($rentId);

//     // Load the view and pass the rent data
//     $pdf = PDF::loadView('rents.rent-status-pdf', compact('rent'));


//     return $pdf->stream('rent-status.pdf'); 
// }

    
}


