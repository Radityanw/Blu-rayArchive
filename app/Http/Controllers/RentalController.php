<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\BluRay;
use App\Jobs\UpdateRentalStatusJob;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class RentalController extends Controller
{
    public function approveReturn($id)
{
    // Find the rental record by ID
    $rental = Rental::find($id);

    if ($rental && $rental->status === 'Return Requested') {
        
        $rental->status = 'Returned';
        $rental->save();

        
        $bluray = BluRay::find($rental->blurays_id);
        if ($bluray) {
            $bluray->status = 'available'; 
            $bluray->save();
    }

     return redirect()->back()->with('success', 'Return approved and Blu-ray status updated.');
    }


    return redirect()->back()->with('error', 'Unable to approve return.');
}
public function updateStatuses()
    {
        UpdateRentalStatusJob::dispatch();
        return response()->json(['message' => 'Rental status update job dispatched!']);
    }

    public function requestReturn($id)
    {
        // Find the rental by its ID
        $rental = Rental::find($id);

        if (!$rental || $rental->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Rental not found or you do not have permission to return this Blu-ray.');
        }

        $rental->status = 'Return Requested';
        $rental->save();

        return redirect()->back()->with('success', 'Return request has been sent successfully.');
    }
   
    public function checkAndCalculateFine()
{
    $rentals = Rental::where('status', 'Rented')->get();

    foreach ($rentals as $rental) {
        $currentDate = Carbon::now();
        $dueDate = Carbon::parse($rental->due_date);

        if ($currentDate->greaterThan($dueDate)) {
    
            $daysOverdue = $currentDate->diffInDays($dueDate);

    
            $fine = $daysOverdue * 10;

            $rental->fine = $fine *-1;
            $rental->save();
        }
    }

    return redirect()->back()->with('success', 'Fines updated successfully!');
}

        
}
