<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UtilisateurController extends Controller
{
    // S'inscrire
    public function sinscrire(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'mot_de_passe' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_de_passe' => $request->mot_de_passe,
        ]);

        return response()->json($utilisateur, 201);
    }

    // Se connecter
    public function seConnecter(Request $request)
    {
        $utilisateur = Utilisateur::where('email', $request->email)->first();

        if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        // Générer un token d'authentification si tu utilises un système comme Laravel Sanctum
        return response()->json(['message' => 'Connexion réussie'], 200);
    }

    // Modifier le profil
    public function modifierProfil(Request $request, $id)
    {
        $utilisateur = Utilisateur::find($id);

        if (!$utilisateur) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        $utilisateur->update($request->all());

        return response()->json(['message' => 'Profil modifié avec succès'], 200);
    }

    // Consulter le profil
    public function consulterProfil($id)
    {
        $utilisateur = Utilisateur::find($id);

        if (!$utilisateur) {
            return response()->json(['error' => 'Utilisateur non trouvé'], 404);
        }

        return response()->json($utilisateur, 200);
    }
    public function supprimer_utilisateur($id)
    {
        $utilisateur = User::find($id); // Ou le modèle utilisé pour les utilisateurs

        if (!$utilisateur) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $utilisateur->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès'], 200);
    }
}

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    // Autres méthodes

    // Méthode pour modifier le profil de l'utilisateur
    public function modifierProfil(Request $request, Utilisateur $utilisateur)
    {
        // Validation des données
        $data = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:utilisateurs,email,' . $utilisateur->id,
            'mot_de_passe' => 'nullable|string|min:8|confirmed',
        ]);

        // Appel à la méthode modifierProfil du modèle
        $utilisateur->modifierProfil($data);

        // Réponse JSON
        return response()->json(['message' => 'Profil mis à jour avec succès'], 200);
    }
}

