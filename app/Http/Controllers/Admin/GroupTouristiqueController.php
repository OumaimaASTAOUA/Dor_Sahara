<?php

namespace App\Http\Controllers\Admin;

use App\Models\GroupTouristique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class GroupTouristiqueController extends Controller
{
    public function index()
    {
        try {
            $groups = GroupTouristique::latest()->get();
            return view('admin.group_touristiques.index', compact('groups'));
        } catch (\Exception $e) {
            Log::error('Error fetching groups: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Erreur serveur', 'errors' => []], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|string|max:50',
                'max_people' => 'required|integer|min:1',
                'starting_point' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        try {
                            $path = $image->store('groups', 'public');
                            $imagePaths[] = $path;
                        } catch (\Exception $e) {
                            Log::error('Error storing image: ' . $e->getMessage());
                            return response()->json([
                                'status' => false,
                                'message' => 'Erreur lors de l\'enregistrement de l\'image',
                                'errors' => ['images' => ['Erreur lors de l\'enregistrement de l\'image']]
                            ], 500);
                        }
                    }
                }
            }

            $group = GroupTouristique::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration' => $request->duration,
                'max_people' => $request->max_people,
                'starting_point' => $request->starting_point,
                'price' => $request->price,
                'images' => $imagePaths,
                'caravan_name' => $request->caravan_name ? array_map('trim', explode(',', $request->caravan_name)) : [],
                'registration_link' => $request->registration_link,
                'social_media_links' => $request->social_media_links ? array_map('trim', explode(',', $request->social_media_links)) : []
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Groupe ajouté avec succès',
                'data' => $group
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error storing group: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'errors' => []
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $group = GroupTouristique::findOrFail($id);
            return response()->json($group);
        } catch (\Exception $e) {
            Log::error('Error fetching group: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Groupe non trouvé', 'errors' => []], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $group = GroupTouristique::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'duration' => 'required|string|max:50',
                'max_people' => 'required|integer|min:1',
                'starting_point' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->only([
                'title',
                'description',
                'duration',
                'max_people',
                'starting_point',
                'price',
                'registration_link'
            ]);

            if ($request->hasFile('images')) {
                if ($group->images && is_array($group->images)) {
                    foreach ($group->images as $image) {
                        if (Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }

                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        try {
                            $path = $image->store('groups', 'public');
                            $imagePaths[] = $path;
                        } catch (\Exception $e) {
                            Log::error('Error storing image: ' . $e->getMessage());
                            return response()->json([
                                'status' => false,
                                'message' => 'Erreur lors de l\'enregistrement de l\'image',
                                'errors' => ['images' => ['Erreur lors de l\'enregistrement de l\'image']]
                            ], 500);
                        }
                    }
                }
                $data['images'] = $imagePaths;
            } else {
                $data['images'] = $group->images;
            }

            $data['caravan_name'] = $request->caravan_name ? array_map('trim', explode(',', $request->caravan_name)) : $group->caravan_name;
            $data['social_media_links'] = $request->social_media_links ? array_map('trim', explode(',', $request->social_media_links)) : $group->social_media_links;

            $group->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Groupe modifié avec succès',
                'data' => $group
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating group: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'errors' => []
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $group = GroupTouristique::findOrFail($id);

            if ($group->images && is_array($group->images)) {
                foreach ($group->images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $group->delete();

            return response()->json([
                'status' => true,
                'message' => 'Groupe supprimé avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting group: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'errors' => []
            ], 500);
        }
    }
}
