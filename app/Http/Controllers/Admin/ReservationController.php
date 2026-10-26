<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display all reservations
     */
    public function index(): View
    {
        $reservations = Reservation::with('user')->latest()->get();
        return view('admin.reservation.index', compact('reservations'));
    }

    /**
     * Update reservation status (approved / canceled / pending)
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,canceled']
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);

        toastr()->success('Reservation status updated successfully!');
        return redirect()->back();
    }

    /**
     * Delete reservation
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        toastr()->success('Reservation deleted successfully!');
        return redirect()->back();
    }
}

