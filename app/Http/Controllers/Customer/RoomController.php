<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Room;
use App\Models\RoomReservationItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $room = Room::with(['hotel:id,name,address_line_1,city', 'category:id,name']);
        $room = $this->searchAndFilter($room, $request);

        if ($request->has('check_in') or $request->has('check_out')) {
            $startDate = Carbon::parse($request->check_in);
            $endDate = Carbon::parse($request->check_in);

           // get booked room with room id 

            $bookedRooms = RoomReservationItem::select(DB::raw('COUNT(room_id) as booked_room, room_id'))
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q2) use ($startDate) {
                    $q2->where('start_date', '<=', $startDate)
                        ->where('end_date', '>=', $startDate);
                })
                ->orWhere(function ($q3) use ($endDate) {
                    $q3->where('start_date', '<=', $endDate)
                        ->where('end_date', '>=', $endDate);
                })
                ->orWhere(function ($query1) use ($startDate, $endDate) {
                    $query1->where('end_date', '<=', $endDate)
                        ->where('start_date', '>=', $startDate);
                });
            })
            ->groupBy('room_id')
            ->get();

            $bookedRooms = $bookedRooms->toArray();

            // if this empty then retrieve all the rooms from the rooms  table
            
            $isRoomsNotReserved =  empty($bookedRooms);

            if ($isRoomsNotReserved) {
                $room = $room->select(['*']);
            }
            
            // get the free rooms 

            else {
                // $freeRooms = [];
                $bookedRoomRoomIds = [];
                $bookedRoomBookCount = [];

                foreach($bookedRooms as $bookedRoom) {
                    array_push($bookedRoomRoomIds, $bookedRoom['room_id']);
                    array_push($bookedRoomBookCount, $bookedRoom['booked_room']);
                }

                $freeRooms = Room::whereIn('id', $bookedRoomRoomIds)
                    ->whereIn('total_rooms', '>', $bookedRoomBookCount)
                    ->get(['id', 'total_rooms', 'max_occupancy']);
                    
               
                // foreach ($bookedRooms as $bookedRoom) {
                //     array_push($freeRooms, Room::where('id', $bookedRoom['room_id'])
                //     ->where('total_rooms', '>', $bookedRoom['booked_room'])
                //     ->get(['id', 'total_rooms', 'max_occupancy']));
                // }

                // fetch other rooms that are not booked
                $notBookedRooms = [];

               foreach ($freeRooms as $freeRoom) {
                    foreach($freeRoom as $room)
                    {
                        array_push($notBookedRooms, Room::where('id', '!=', $room->id)
                        ->get(['id', 'max_occupancy', 'total_rooms']));
                    }
               }
               $numberOfGuest = $request->number_of_guest ?? 2;
                if ($numberOfGuest >= 2) {

                    $roomsRequired = [];


                    foreach ($freeRooms as $freeRoom) {
                        foreach($freeRoom as $room)
                        {
                            array_push($roomsRequired, [
                                'required_rooms' =>  $numberOfGuest / $room->max_occupancy,
                                'room_id' =>  $room->id,
                            ]);
                        }
                    }

                    // check for available rooms as per requirement

                    $availableRooms = [];

                    foreach ($freeRooms as $freeRoom) {
                        foreach($freeRoom as $room)
                        {
                            foreach($bookedRooms as $bookedRoom) {
                                if ($bookedRoom['room_id'] == $room->id) {
                                    foreach($roomsRequired as $roomRequired) {
                                        $availableRoom =  $room->total_rooms - $bookedRoom['booked_room'];

                                        if ($availableRoom >= $roomRequired['required_rooms'])
                                        {
                                            array_push($availableRooms, $room->id);
                                        }

                                    }
                                }
                            }
                        }
                    }

                }

                $availableRoomIds = [];

            
                foreach ($notBookedRooms as $notBookedRoom) {

                     foreach($notBookedRoom as $room) {
                        $guestLesThanOrEqualToAllNotBookedRoomRequirement = $numberOfGuest <= $room->max_occupancy *  $room->total_rooms;

                        if (!empty($availableRooms)) {

                             foreach ($availableRooms as $availableRoom) {
                                array_push($availableRoomIds, $room->id, $availableRoom);
                             }
                        }
                        elseif($guestLesThanOrEqualToAllNotBookedRoomRequirement) {
                              {
                                array_push($availableRoomIds, $room->id);
                            }
                        }
                     }
                }
                $room = $room->whereIn('id', $availableRoomIds);
            }
    
        }   
        
        $room = $room->paginate(8);

        return view('index', [
            'rooms' => $room,
            'categories' => $this->catagories(),
            'location' =>  $request->location ?? '',
            'category_id' =>  $request->category_id ?? '',
            'check_in' =>  $request->check_in ?? '',
            'check_out' =>  $request->check_out ?? '',
            'number_of_guest' =>  $request->number_of_guest ?? ''
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

