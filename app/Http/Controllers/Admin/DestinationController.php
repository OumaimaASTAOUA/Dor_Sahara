<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class DestinationController extends Controller
{
       public function index()
    {
        $destinations = Destination::latest()->get();
        return view('admin.destinations.index', compact('destinations'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
                'images.*' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('destinations', 'public');
                        $imagePaths[] = basename($path);
                        Log::debug('Image stored:', ['path' => $path, 'filename' => basename($path)]);
                    }
                }
            }

            $destination = Destination::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'images' => $imagePaths,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Destination added successfully / تمت إضافة الوجهة بنجاح',
                'data' => $destination,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in store:', ['errors' => $e->errors()]);
            return response()->json([
                'status' => false,
                'message' => 'Validation failed / فشل التحقق',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error in store:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status' => false,
                'message' => 'An error occurred / حدث خطأ',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $destination = Destination::findOrFail($id);
            return response()->json($destination);
        } catch (\Exception $e) {
            Log::error('Error fetching destination: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'الوجهة غير موجودة', 'errors' => []], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $destination = Destination::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'required|string|max:255',
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
                'location'
            ]);

            if ($request->hasFile('images')) {
                if ($destination->images && is_array($destination->images)) {
                    foreach ($destination->images as $image) {
                        if (Storage::disk('public')->exists($image)) {
                            Storage::disk('public')->delete($image);
                        }
                    }
                }

                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        try {
                            $path = $image->store('destinations', 'public');
                            $imagePaths[] = $path;
                        } catch (\Exception $e) {
                            Log::error('Error storing image: ' . $e->getMessage());
                            return response()->json([
                                'status' => false,
                                'message' => 'خطأ أثناء حفظ الصورة',
                                'errors' => ['images' => ['خطأ أثناء حفظ الصورة']]
                            ], 500);
                        }
                    }
                }
                $data['images'] = $imagePaths;
            } else {
                $data['images'] = $destination->images;
            }

            $destination->update($data);

            return response()->json([
                'status' => true,
                'message' => 'تم تعديل الوجهة بنجاح',
                'data' => $destination
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating destination: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'خطأ في الخادم: ' . $e->getMessage(),
                'errors' => []
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $destination = Destination::findOrFail($id);

            if ($destination->images && is_array($destination->images)) {
                foreach ($destination->images as $image) {
                    if (Storage::disk('public')->exists($image)) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }

            $destination->delete();

            return response()->json([
                'status' => true,
                'message' => 'تم حذف الوجهة بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting destination: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'خطأ في الخادم: ' . $e->getMessage(),
                'errors' => []
            ], 500);
        }
    }
}
