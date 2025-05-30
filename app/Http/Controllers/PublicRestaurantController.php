<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicRestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['category', 'menus'])->get();
        $categories = Category::all();
        return view('restaurants.index', compact('restaurants', 'categories'));
    }

    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);
        return response()->json(['message' => 'Commentaire ajouté !']);
    }



    public function updateCart(Request $request)
    {
        $cart = $request->input('cart', []);
        Session::put('cart', $cart);
        return response()->json(['success' => true]);
    }
}
