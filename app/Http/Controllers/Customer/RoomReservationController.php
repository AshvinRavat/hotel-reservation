<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomReservation;
use App\Models\RoomReservationItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('customer.reservation.index', [
           'roomReservations' =>  $roomReservations
        ]);
    }

    public function reservationDetail(RoomReservation $reservation)
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
        return view('customer.reservation.reservation-detail', [
           'reservationDetails' => $reservation
        ]);
    }

    public function getBookingDetailsAndCreatingBill(Request $request)
    {
        $validatedFormData = $request->validate([
            'room_id' => ['required'],
            'price' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:today', "after_or_equal:$request->start_date"],
            'total_persons' => ['required', 'integer', 'max:50'],
        ]);
        $roomsDetails = '';
        $isReserved = $this->isReserved($validatedFormData);


        if ($isReserved) {
            $request->flash();
            return back()->with('error', 'Reservation is not available please select other dates');
        }

        $billDetails = $this->getTotalOfBillAndPutDataToSession($validatedFormData);

        $billDetails['total_rooms'] = 1;
        $totalPersons = $validatedFormData['total_persons'];
        $maxOccupancyOfRoom = $request->max_occupancy;


        if ($totalPersons > $maxOccupancyOfRoom) {
            $categoryId = $request->category_id;

            $room = new Room();
            $totalRoomsAvailabel = $room->where('category_id', $categoryId)
            ->count('id');

            //count total room to be required
            $totalRoomsRequired = $totalPersons / $maxOccupancyOfRoom;
            $isRoomsNotAvailable = $totalRoomsAvailabel < $totalRoomsRequired;

            if ($isRoomsNotAvailable) {
                $request->flash();
                return back()->with('error', 'Rooms not available');
            }

            $roomIds = $room->where('category_id', $categoryId)->get(['id']);

            $startDate =  $validatedFormData['start_date'];
            $endDate =  $validatedFormData['end_date'];

            $isReserved = RoomReservationItem::whereIn('room_id', $roomIds)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q2) use ($startDate) {
                    $q2->where('start_date', '<=', $startDate);
                    $q2->where('end_date', '>=', $startDate);
                });
                $query->orWhere(function ($q3) use ($endDate) {
                    $q3->where('start_date', '<=', $endDate);
                    $q3->where('end_date', '>=', $endDate);
                });
                $query->orWhere(function ($query1) use ($startDate, $endDate) {
                    $query1->where('end_date', '<=', $endDate);
                    $query1->where('start_date', '>=', $startDate);
                });
            })->count();

            if ($isReserved) {
                $request->flash();
                return back()->with('error', 'Reservation is not available please select other dates');
            } else {
                $roomsDetails = $room->where('category_id', $categoryId)
                ->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
                ->select([
                    'hotels.name as hotel',
                    'rooms.image', 'rooms.price', 'rooms.id as room_id'
                ])->get();

                $roomPrices = [];
                $roomIds = [];

                foreach ($roomsDetails as $roomsDetail) {
                    $roomIds[] = $roomsDetail['room_id'];
                    $roomPrices[] = $roomsDetail['price'];
                }
                $roomPricesEachRoom = $roomPrices;
                $roomPrices = collect($roomPrices);
                $totalRoomPrices = $roomPrices->sum();

                $billDetails['total_rooms'] = $totalRoomsAvailabel;
                $billDetails['total_amount'] = $billDetails['total_days'] * $totalRoomPrices;
                $billDetails['total_amount_by_rooms'] = $totalRoomPrices;

                $billDetails['room_id'] = $roomIds;
                $billDetails['price'] = $roomPricesEachRoom;
                session()->put('billDetails', $billDetails);
            }
        }

        return view('customer.room.bill-details', [
            'billDetails' => $billDetails,
            'roomsDetails' => $roomsDetails
        ]);
    }

    public function confirmBookingAndReservation()
    {
        $billDetails = session()->get('billDetails');

        $billDetails['user_id'] = auth()->user()->id;
        $roomReservation = new RoomReservation();

        $roomReservation = $roomReservation->create([
            'total_amount' => $billDetails['total_amount']
        ]);

        $totalRooms = 0;
        if (is_array($billDetails['room_id'])) {
            $totalRooms = count($billDetails['room_id']);
            $updateBillDetails = [];
        }
        if ($totalRooms > 1) {
            for ($count = 0; $count <$totalRooms; $count++) {
                array_push($updateBillDetails, [
                    'room_id' => $billDetails['room_id'][$count],
                    'price' => $billDetails['price'][$count],
                    'user_id' => $billDetails['user_id'],
                    'start_date' => $billDetails['start_date'],
                    'end_date' => $billDetails['end_date'],
                    'total_persons' => $billDetails['total_persons'],
                    'total_rooms' => $billDetails['total_rooms'],
                ]);
                $roomReservation->roomReservationItems()->create($updateBillDetails[$count]);
            }
        } else {
            $billDetails['total_rooms'] = 1;
            $roomReservation->roomReservationItems()->create($billDetails);
        }

        return to_route('customer.reservation_success');
    }

    public function isReserved($billDetails)
    {
        $startDate =  $billDetails['start_date'];
        $endDate =  $billDetails['end_date'];

        $isReserved = RoomReservationItem::where('room_id', $billDetails['room_id'])
        ->where(function ($query) use ($startDate, $endDate) {
            $query->where(function ($q2) use ($startDate) {
                $q2->where('start_date', '<=', $startDate);
                $q2->where('end_date', '>=', $startDate);
            });
            $query->orWhere(function ($q3) use ($endDate) {
                $q3->where('start_date', '<=', $endDate);
                $q3->where('end_date', '>=', $endDate);
            });
            $query->orWhere(function ($query1) use ($startDate, $endDate) {
                $query1->where('end_date', '<=', $endDate);
                $query1->where('start_date', '>=', $startDate);
            });
        })->count();

        return $isReserved;
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
