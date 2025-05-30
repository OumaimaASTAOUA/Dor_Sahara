<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            Log::info('Utilisateurs récupérés pour la vue index', ['count' => $users->count()]);
            return view('admin.user.index', compact('users'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la récupération des utilisateurs: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $id = (int)$id;
            Log::info('Tentative de mise à jour de l\'utilisateur', [
                'id' => $id,
                'request_data' => $request->all()
            ]);

            if ($id <= 0) {
                Log::warning('ID utilisateur invalide fourni: ' . $id);
                return response()->json(['error' => 'ID utilisateur invalide'], 400);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'is_admin' => 'required|boolean',
                'payment_method' => 'required|in:0,1',
            ]);

            $user = User::where('id', $id)->first();
            if (!$user) {
                Log::error('Utilisateur non trouvé dans la base de données', ['id' => $id]);
                return response()->json(['error' => 'Utilisateur non trouvé dans la base de données (ID: ' . $id . ')'], 404);
            }

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'is_admin' => $validated['is_admin'],
                'payment_method' => $validated['payment_method'],
            ]);

            Log::info('Utilisateur mis à jour avec succès', ['id' => $id]);

            return response()->json([
                'message' => 'Utilisateur mis à jour avec succès',
                'user' => $user
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Erreur de validation lors de la mise à jour de l\'utilisateur ID ' . $id . ': ' . json_encode($e->errors()));
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Utilisateur non trouvé via findOrFail: ID ' . $id);
            return response()->json(['error' => 'Utilisateur non trouvé dans la base de données (ID: ' . $id . ')'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'utilisateur ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la mise à jour de l\'utilisateur: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $id = (int)$id;
            Log::info('Tentative de suppression de l\'utilisateur', ['id' => $id]);

            if ($id <= 0) {
                Log::warning('ID utilisateur invalide fourni: ' . $id);
                return response()->json(['error' => 'ID utilisateur invalide'], 400);
            }

            $user = User::where('id', $id)->first();
            if (!$user) {
                Log::error('Utilisateur non trouvé dans la base de données', ['id' => $id]);
                return response()->json(['error' => 'Utilisateur non trouvé dans la base de données (ID: ' . $id . ')'], 404);
            }

            $user->delete();

            Log::info('Utilisateur supprimé avec succès', ['id' => $id]);

            return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Utilisateur non trouvé via findOrFail: ID ' . $id);
            return response()->json(['error' => 'Utilisateur non trouvé dans la base de données (ID: ' . $id . ')'], 404);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'utilisateur ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage()], 500);
        }
    }
}
