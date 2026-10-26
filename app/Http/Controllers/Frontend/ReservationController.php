<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Reservation\ReservationCreateRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Store new table reservation (via AJAX)
     */

    public function store(ReservationCreateRequest $request)
    {
        Reservation::create([
            'user_id' => Auth::id(), // سيكون null إذا كان الزائر غير مسجل
            'name' => $request->name,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'persons' => $request->persons,
            'status' => 'pending',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Table reservation request received! We will contact you soon.'
        ]);
    }
}
