<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Apartment;

class PublicHotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::all();
        $apartments = Apartment::all();

        return view('hotels.index', compact('hotels', 'apartments'));
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }
}
