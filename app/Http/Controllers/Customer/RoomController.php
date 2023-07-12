<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Room;
use App\Models\RoomReservationItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $room = Room::with(['hotel:id,name,address_line_1,city', 'category:id,name']);
        $room = $this->searchAndFilter($room, $request);

        if ($request->has('check_in') or $request->has('check_out')) {
            $startDate = Carbon::parse($request->check_in);
            $endDate = Carbon::parse($request->check_in);

          
            $RoomReservations = RoomReservationItem::where('available_rooms', '<=', 1)
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
            })->get(['room_id']);

            $reservedRoomIds = [];

            foreach ($RoomReservations as $RoomReservation) {
                array_push($reservedRoomIds, $RoomReservation->room_id);
            }

            $room = $room->whereNotIn('id',$reservedRoomIds);
           
        }   

        $room = $room->paginate(8);

        return view('index', [
            'rooms' => $room,
            'categories' => $this->catagories(),
            'location' =>  $request->location ?? '',
            'category_id' =>  $request->category_id ?? '',
            'check_in' =>  $request->check_in ?? '',
            'check_out' =>  $request->check_out ?? ''
        ]);
    }

    public function roomDetails(Room $room)
    {

        $roomDetails = $room->with(['hotel:id,name,address_line_1,city', 'category:id,name'])
        ->firstWhere('id', $room->id);

        return view('customer.room.room-detail', [
            'roomDetail' => $roomDetails
        ]);
    }

    public function searchAndFilter($room, $request) {
        
        if ($request->has('location'))
        {
            $room = $room->whereHas('hotel', function($query) use ($request) {
                return $query->where('address_line_1', 'LIKE', "%$request->location%");
            });
           
        }

        if ($request->has('category_id') && $request->category_id != 0) {
            $room = $room->whereHas('category', function($query) use ($request) {
                return $query->where('id', $request->category_id);
            });
        }

        return $room;
    }

    public function catagories()
    {
        return Category::all('id', 'name');
    }
}

