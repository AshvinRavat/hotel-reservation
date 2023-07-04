<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request) {

        $searchedValue = $request->search_item ?? '';
        $hotel = new Hotel();
        $hotel = $hotel->select(['*']);

        if($request->has('search_item')) {
            $request->validate([
                'search_item' => ['required']
            ]);
            $hotel = $hotel->where('city', 'LIKE', "%$request->search_item%");
        }

        $hotel =$hotel->paginate();
        return view('index', [
            'hotels' => $hotel,
            'searchedValue' => $searchedValue,
        ]);
    }
}
