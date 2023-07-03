<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   public function index()
   {
   }

   public function create()
   {
      $hotels = $this->getHotelListOfOwner();

      return view('owner.room.create', [
         'hotels' => $hotels
      ]);
   }

   public function getHotelListOfOwner()
   {
      $hotel = new Hotel();
      return $hotel->where('user_id', auth()->user()->id)->select(['id', 'name'])->get();
   }
}
