<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userCount = $users->count();
        $adminCount = User::where('is_admin', 1)->count();
        return view('admin.user.index', compact('users', 'userCount', 'adminCount'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'is_admin' => 'required|boolean',
                'payment_method' => 'required|in:1,2,3,4', 
            ]);

            if ($validated['is_admin'] == 1) {
                $existingAdmin = User::where('is_admin', 1)
                                    ->where('id', '!=', $id)
                                    ->first();
                if ($existingAdmin) {
                    Log::warning('Attempt to set is_admin=1 when another admin exists:', [
                        'user_id' => $id,
                        'existing_admin_id' => $existingAdmin->id
                    ]);
                    return response()->json([
                        'status' => false,
                        'message' => 'Erreur : Il ne peut y avoir qu\'un seul administrateur.',
                        'errors' => ['is_admin' => ['Il ne peut y avoir qu\'un seul administrateur.']]
                    ], 422);
                }
            }

            $user->update($validated);

            Log::info('User updated successfully:', ['user_id' => $user->id]);
            return response()->json([
                'status' => true,
                'message' => 'Utilisateur mis à jour avec succès !'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error updating user:', ['errors' => $e->errors()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la modification de l\'utilisateur.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error updating user:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur serveur lors de la modification de l\'utilisateur.',
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->is_admin == 1) {
                $adminCount = User::where('is_admin', 1)->count();
                if ($adminCount <= 1) {
                    Log::warning('Attempt to delete the only admin:', ['user_id' => $id]);
                    return response()->json([
                        'status' => false,
                        'message' => 'Erreur : Impossible de supprimer le seul administrateur.'
                    ], 422);
                }
            }

            $user->delete();

            Log::info('User deleted successfully:', ['user_id' => $id]);
            return response()->json([
                'status' => true,
                'message' => 'Utilisateur supprimé avec succès !'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting user:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Erreur lors de la suppression de l\'utilisateur.'
            ], 500);
        }
    }
}
