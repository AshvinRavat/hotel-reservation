<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BecomeOwnerController extends Controller
{
   public function index()
   {
      if(auth()->user()->role == "1") {
         return view('owner.index');
      }
        return view('owner.become-owner');
   }

   public function updatingUserAsOwner(Request $request)
   {
      $owner = $request->validate([
         'pan_number' => ['required', 'max:10', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
         "address_line_1" => ['required', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
         "address_line_2" => ['nullable', 'max:50', 'regex:/^([a-zA-Z0-9 \']*)$/'],
         "city" => ['required', 'max:50', 'regex:/^([a-zA-Z \']*)$/'],
         "post_code" => ['required', 'digits_between:4,5'],
      ]);

      $owner['role'] = 1;

      $user = new User();
      $user->where('id', auth()->user()->id)->update($owner);

      return to_route('become_owner_successfully')->with('success', 'You are now become owner successfully');
   }

   public function becomingOwnerSuccessfully()
   {
       if(session('success')) {
         return view('owner.become-owner-successful');
       }

       return to_route('become_owner_index');
   }
}
