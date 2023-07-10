<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $room = Room::with(['hotel:id,name,address_line_1,city', 'category:id,name'])
        ->paginate(8);

        return view('index', [
            'rooms' => $room
        ]);
    }

    public function roomDetails(Room $room)
    {
        // dd($room->id);

        $roomDetails = $room->with(['hotel:id,name,address_line_1,city', 'category:id,name'])
        ->firstWhere('id', $room->id);

        return view('customer.room.room-detail', [
            'roomDetail' => $roomDetails
        ]);
    }

    public function catagories()
    {
        return Category::all();
    }
}
