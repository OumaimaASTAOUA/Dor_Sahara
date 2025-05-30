<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Restaurant;
class MenuController extends Controller
{

public function index($restaurantId)
{
    $restaurant = Restaurant::findOrFail($restaurantId);
    $menus = $restaurant->menus;
    return view('menus.index', compact('restaurant', 'menus'));
}

public function create($restaurantId)
{
    $restaurant = Restaurant::findOrFail($restaurantId);
    return view('menus.create', compact('restaurant'));
}

public function store(Request $request, $restaurantId)
{
    $data = $request->validate([
        'name' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'image' => 'nullable|image'
    ]);

    $data['restaurant_id'] = $restaurantId;

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('menus', 'public');
    }

    Menu::create($data);
    return redirect()->route('menus.index', $restaurantId)->with('success', 'Plat ajouté');
}
}
