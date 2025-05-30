<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Hotel;
class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();
        $hotels = Hotel::all();
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
            $imagePath = $request->file('image')->store('apartments', 'public');
            $validated['image'] = basename($imagePath); 
        }

        Apartment::create($validated);

        return response()->json(['status' => true, 'message' => 'Appartement ajouté avec succès !']);
    }

    public function update(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);

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
            if ($apartment->image) {
                Storage::disk('public')->delete('apartments/' . $apartment->image);
            }
            $imagePath = $request->file('image')->store('apartments', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            $validated['image'] = $apartment->image;
        }

        $apartment->update($validated);

        return response()->json(['status' => true, 'message' => 'Appartement modifié avec succès !']);
    }

    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);

        if ($apartment->image) {
            Storage::disk('public')->delete('apartments/' . $apartment->image);
        }
        $apartment->delete();

        return response()->json(['status' => true, 'message' => 'Appartement supprimé avec succès !']);
    }
}
