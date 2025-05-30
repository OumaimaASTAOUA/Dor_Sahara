<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        $apartments = Apartment::all();
        return view('admin.hotels.index', compact('hotels', 'apartments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'availability' => 'required|boolean',
            'status' => 'required|in:Actif,Inactif',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('hotels', 'public');
            $validated['image'] = basename($imagePath);
        }

        Hotel::create($validated);

        return response()->json(['status' => true, 'message' => 'Hôtel ajouté avec succès !']);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'availability' => 'required|boolean',
            'status' => 'required|in:Actif,Inactif',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($hotel->image) {
                Storage::disk('public')->delete('hotels/' . $hotel->image);
            }
            $imagePath = $request->file('image')->store('hotels', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            $validated['image'] = $hotel->image;
        }

        $hotel->update($validated);

        return response()->json(['status' => true, 'message' => 'Hôtel modifié avec succès !']);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        if ($hotel->image) {
            Storage::disk('public')->delete('hotels/' . $hotel->image);
        }
        $hotel->delete();

        return response()->json(['status' => true, 'message' => 'Hôtel supprimé avec succès !']);
    }
}
