<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\RoomReservation;
use App\Models\RoomReservationItem;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;

class RoomReservationController extends Controller
{
    public function index()
    {
        $roomReservations = RoomReservation::with([
            'roomReservationItems' => [
                'rooms' => [
                    'hotel'
                ]
            ]
        ])->get();

        return view('owner.reservation.index', [
           'roomReservations' =>  $roomReservations
        ]);
    }

    public function orderDetail(RoomReservation $reservation)
    {
        $reservation = $reservation->with([
            'roomReservationItems' => [
                'rooms' => [
                    'hotel'
                ],
                'users'
            ]
        ])
        ->where('id', $reservation->id)
        ->get();
         return view('owner.reservation.order-detail', [
            'reservationDetails' => $reservation
         ]);
    }

    public function updateReservationStatus(HttpRequest $request)
    {
        $request->validate([
            'reservation_id' => 'required'
        ]);

       $roomReservation = new RoomReservation();
       $roomReservation->where('id', $request->reservation_id)
       ->update([
            'status' => $request->status
       ]);

       return back();
    }
}
