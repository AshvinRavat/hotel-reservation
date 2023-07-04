<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RoomReservation;
use App\Models\RoomReservationItem;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function getBookingDetails(Request $request)
    {
        $billDetails = $request->validate([
            'room_id' => ['required'],
            'price' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:today'],
            'total_persons' => ['required', 'integer'],
        ]);

        // $roomReservation = new RoomReservationItem();
        // $roomReservation = $roomReservation->where('end_date', '>',  $billDetails['start_date'])
        // ->select(['end_date']);

        // if (!empty($roomReservation)) {
        //     return back()->with('start_date', 'Please select other date');
        // }
        session()->put('billDetails', $billDetails);

        return view('customer.room.bill-details', [
            'billDetails' => $billDetails
        ]);
    }

    public function confirmBookingAndReservation()
    {
        $billDetails = session()->get('billDetails');
        $billDetails['user_id'] = auth()->user()->id;
        $billDetails['total_rooms'] = 1;

        $roomReservation = new RoomReservation();

        $roomReservationId = $roomReservation->create([
            'total_amount' => 1500
        ]);
        $billDetails['room_reservation_id'] = $roomReservationId->id;

        // $roomReservationItem = new RoomReservationItem();
        // $roomReservationItem->room_reservation_id = 1;
        // $roomReservationItem->room_id = 1;
        // $roomReservationItem->user_id = 1;
        // $roomReservationItem->start_date = '2023 -07 -04';
        // $roomReservationItem->end_date = '2023 -07 -04';
        // $roomReservationItem->total_persons = 5;
        // $roomReservation->roomReservationItems()->save($roomReservationItem);

        $roomReservation->roomReservationItems()->create([
            'room_reservation_id' => 1,
            'room_id' => 1,
            'user_id' => 1,
            'start_date' => '2023-07-04',
            'end_date' => '2023-07-04',
            'total_persons' => 5,
            'total_rooms' => 1,
            'price' => 10,
            'room_reservation_id' => 10,
        ]);

    }
}
