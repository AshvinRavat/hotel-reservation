<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RoomReservation;
use App\Models\RoomReservationItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomReservationController extends Controller
{
    public function getBookingDetailsAndCreatingBill(Request $request)
    {
        $validatedFormData = $request->validate([
            'room_id' => ['required'],
            'price' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:today', "after_or_equal:$request->start_date"],
            'total_persons' => ['required', 'integer', 'max:50'],
        ]);

       $reservationNotAvaliable = $this->reservationAvailable($validatedFormData);

        if ($reservationNotAvaliable) {
            $request->flash();
            return back()->with('error', 'Reservation is not available please select other dates');
        }

        $billDetails = $this->getTotalOfBillAndPutDataToSession($validatedFormData);

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
            'total_amount' => $billDetails['total_amount']
        ]);

        $roomReservation->roomReservationItems()->create($billDetails);

        return to_route('customer.reservation_success');
    }

    public function reservationAvailable($billDetails)
    {
        $roomReservation = new RoomReservationItem();

        $reservationNotAvaliable = $roomReservation->where('end_date', '>=', $billDetails['start_date'])
        ->where('room_id', $billDetails['room_id'])
        ->select(['end_date'])
        ->count();

        return $reservationNotAvaliable;
    }

    public function getTotalOfBillAndPutDataToSession($validatedFormData)
    {
        $fromDate = Carbon::parse($validatedFormData['start_date']);
        $toDate = Carbon::parse($validatedFormData['end_date']);

        $totalDays = $fromDate->diffInDays($toDate);

        if ($fromDate == $toDate) {
            $totalDays = 1;
        }

        $validatedFormData['total_days'] = $totalDays;
        $validatedFormData['total_amount'] = $totalDays * $validatedFormData['price'];

        session()->put('billDetails', $validatedFormData);

        return $validatedFormData;
    }

    public function reservationSuccess()
    {
        return view('customer.reservation.success');
    }
}
