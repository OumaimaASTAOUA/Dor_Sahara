<?php



namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Comment;
use App\Models\GroupTouristique;
use Illuminate\Http\Request;

class PublicDestinationController extends Controller
{
    public function index()
{
    $destinations = Destination::all();
    $groupTouristiques = GroupTouristique::all();

    return view('destination.index', compact('destinations',  'groupTouristiques'));
}


    public function storeComment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string',
        ]);



        return redirect()->route('destination.index')->with('success', 'Votre commentaire a été ajouté avec succès !');
    }
}
