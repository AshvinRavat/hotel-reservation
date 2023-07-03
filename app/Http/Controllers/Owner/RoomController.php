<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\RoomRequest;
use App\Models\Category;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class RoomController extends Controller
{
    public function index()
    {
      $rooms = Room::join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
      ->get([
         'rooms.*', 'hotels.id as hotel_id', 'hotels.name as hotel'
      ]);
        return view('owner.room.index', [
            'rooms' => $rooms
        ]);
    }

    public function create()
    {
        $hotels = $this->getHotelListOfOwner();
        $categories = $this->categories();

        return view('owner.room.create', [
           'hotels' => $hotels,
           'categories' => $categories
        ]);
    }

    public function store(RoomRequest $request)
    {
       $formValidatedData = $request->validated();

        $image = $formValidatedData['image'];
        $image->store('public/owner/room/');
        $formValidatedData['image'] = $image->hashName();

        $room = new Room();
        $room->create($formValidatedData);

        return to_route('owner.room_index')->with('success', 'Room created successfully');
    }

    public function edit(Room $room)
    {
       return view('owner.room.edit', [
         'room' => $room,
         'hotels' => $this->getHotelListOfOwner(),
         'categories' => $this->categories(),
       ]);
    }

    public function update(RoomRequest $request, Room $room)
    {
      $formValidatedData = $request->validated();

      if ($request->has('image')) {
         $image = $formValidatedData['image'];
         $image->store('public/owner/room/');
         $formValidatedData['image'] = $image->hashName();
      }

      $room->update($formValidatedData);
      return to_route('owner.room_index')->with('success', 'Room updated successfully');
    }

   public function delete(Room $room)
   {
      $room->delete();
      return to_route('owner.room_index')->with('success', 'Room deleted successfully');
   }

    public function getHotelListOfOwner()
    {
        $hotel = new Hotel();
        return $hotel->where('user_id', auth()->user()->id)
        ->select(['id', 'name'])
        ->get();
    }

    public function categories()
    {
        return Category::all();
    }

}
