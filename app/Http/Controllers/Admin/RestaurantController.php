<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('category')->get();
        $menus = Menu::with('restaurant')->get();
        $categories = Category::all();
        return view('admin.restaurants.index', compact('restaurants', 'menus', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'description' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            $imagePath = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('restaurants', 'public');
                $imagePath = basename($imagePath);
                Log::debug('Restaurant image uploaded:', ['path' => $imagePath]);
            }

            Restaurant::create([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'description' => $validated['description'],
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'image' => $imagePath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Restaurant ajouté avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing restaurant:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'ajout du restaurant',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'description' => 'nullable|string',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($restaurant->image) {
                    Storage::disk('public')->delete('restaurants/' . $restaurant->image);
                }
                $imagePath = $request->file('image')->store('restaurants', 'public');
                $validated['image'] = basename($imagePath);
                Log::debug('Restaurant image updated:', ['path' => $validated['image']]);
            } else {
                $validated['image'] = $restaurant->image;
            }

            $restaurant->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Restaurant modifié avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating restaurant:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la modification du restaurant',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            if ($restaurant->image) {
                Storage::disk('public')->delete('restaurants/' . $restaurant->image);
            }
            $restaurant->delete();
            return response()->json([
                'status' => true,
                'message' => 'Restaurant supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting restaurant:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression du restaurant'
            ], 500);
        }
    }

    public function storeMenu(Request $request)
    {
        try {
            $validated = $request->validate([
                'restaurant_id' => 'required|exists:restaurants,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            $imagePath = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('menus', 'public');
                $imagePath = basename($imagePath);
                Log::debug('Menu image uploaded:', ['path' => $imagePath]);
            }

            Menu::create([
                'restaurant_id' => $validated['restaurant_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'image' => $imagePath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Menu ajouté avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing menu:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de l\'ajout du menu',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMenu(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $validated = $request->validate([
                'restaurant_id' => 'required|exists:restaurants,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            ]);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($menu->image) {
                    Storage::disk('public')->delete('menus/' . $menu->image);
                }
                $imagePath = $request->file('image')->store('menus', 'public');
                $validated['image'] = basename($imagePath);
                Log::debug('Menu image updated:', ['path' => $validated['image']]);
            } else {
                $validated['image'] = $menu->image;
            }

            $menu->update($validated);

            return response()->json([
                'status' => true,
                'message' => 'Menu modifié avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating menu:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la modification du menu',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function destroyMenu($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            if ($menu->image) {
                Storage::disk('public')->delete('menus/' . $menu->image);
            }
            $menu->delete();
            return response()->json([
                'status' => true,
                'message' => 'Menu supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting menu:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression du menu'
            ], 500);
        }
    }
}
