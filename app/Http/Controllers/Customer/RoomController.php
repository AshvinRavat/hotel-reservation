<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Hotel $hotel, Request $request)
    {
        $flirtedCategory = $request->category_id ? : '';

        $rooms = $hotel->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
        ->join('categories', 'rooms.category_id', '=', 'categories.id')
        ->where('hotels.id', $hotel->id)
        ->select([
            'hotels.id as hotel_id', 'hotels.name as hotel',
             'categories.name as category',
            'rooms.*'
        ]);

        if($request->has('category_id')) {
            $request->validate([
                'category_id' => ['required']
            ]);
            $rooms = $rooms->where('categories.id', $request->category_id);
        }

        $rooms = $rooms->paginate(8);
        return view('customer.room.index', [
            'rooms' => $rooms,
            'hotel_id' => $hotel->id,
            'categories' => $this->catagories(),
            'flirtedCategory' => $flirtedCategory,
        ]);
    }

    public function viewRoomDetails(Room $room)
    {
        $room = $room->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
        ->join('categories', 'rooms.category_id', '=', 'categories.id')
        ->where('rooms.id', $room->id)
        ->select([
            'hotels.id as hotel_id', 'hotels.name as hotel',
            'categories.id as category_id', 'categories.name as category',
            'rooms.*'
        ])
        ->get();
        $room = $room[0];
         return view('customer.room.room-detail', [
            'room' => $room
         ]);
    }

    public function catagories()
    {
        return Category::all();
    }
}
