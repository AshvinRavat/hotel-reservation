<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RoomReservation;
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

        $roomReservation = $roomReservation->create([
            'total_amount' => 1500
        ]);

        $roomReservation
        ->roomReservationItems()
        ->create($billDetails);
    }
}
