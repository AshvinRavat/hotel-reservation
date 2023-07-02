<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index() {

        $hotel = new Hotel();
        $hotels = $hotel->where('user_id', auth()->user()->id);
         
        return view('owner.hotel.index');

    }

    public function create() {
        return view('owner.hotel.create');
    }

    public function store(Request $request) {

        $formData = $request->validate([
            'name' => ['required','max:50','string','regex:/^([a-zA-Z \']*)$/'],
            "address_line_1" => ['required', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "address_line_2" => ['nullable', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "city" => ['required', 'max:50', 'regex:/^([a-zA-Z \']*)$/'],
            "post_code" => ['required', 'digits_between:4,5'],
            "image" => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
         ]);

         $formData['user_id'] = auth()->user()->id;

         if ($request->hasFile('image')) {
          
            $image =  $request->file('image');
            $image->store('public/hotel/images');
            $formData['image'] = $image->hashName();
        }
        

        $hotel = new Hotel();
        $hotel->create($formData);

    }
}
