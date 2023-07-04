<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotel = new Hotel();

        return view('owner.hotel.index', [
            'hotels' => $hotel->where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function create()
    {
        return view('owner.hotel.create');
    }

    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required','max:50','string','regex:/^([a-zA-Z \']*)$/'],
            "address_line_1" => ['required', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "address_line_2" => ['nullable', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "city" => ['required', 'max:50', 'regex:/^([a-zA-Z \']*)$/'],
            "post_code" => ['required', 'digits:6'],
            "image" => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5048']
         ]);

        $formData['user_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {

            $image =  $request->file('image');
            $image->store('public/hotel/images');
            $formData['image'] = $image->hashName();
        }

        $hotel = new Hotel();
        $hotel->create($formData);
        return to_route('owner.hotel_index')->with('success', 'Hotel created successfully');
    }

    public function edit(Hotel $hotel)
    {
        return view('owner.hotel.edit', [
            'hotel' => $hotel
        ]);
    }

    public function update(Hotel $hotel, Request $request)
    {
        $formData = $request->validate([
            'name' => ['required','max:50','string','regex:/^([a-zA-Z \']*)$/'],
            "address_line_1" => ['required', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "address_line_2" => ['nullable', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
            "city" => ['required', 'max:50', 'regex:/^([a-zA-Z \']*)$/'],
            "post_code" => ['required', 'digits_between:4,5'],
            "image" => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:5048']
         ]);

        if ($request->hasFile('image')) {
            $image =  $request->file('image');
            $image->store('public/hotel/images');
            $formData['image'] = $image->hashName();
        }

        $hotel->update($formData);
        return to_route('owner.hotel_index')->with('success', 'Hotel updated successfully');
    }

    public function delete(Hotel $hotel)
    {
        $hotel->delete();
        return to_route('owner.hotel_index')->with('success', 'Hotel delete successfully');
    }
}
