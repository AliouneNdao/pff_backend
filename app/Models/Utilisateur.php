<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
    ];

    /**
     * Méthode pour inscrire un utilisateur.
     */
    public function inscrire(Request $request)
{
    $data = $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:utilisateurs',
        'mot_de_passe' => 'required|string|min:8',
    ]);

    // Créer un nouvel utilisateur en appelant la méthode inscrire
    $utilisateur = Utilisateur::inscrire([
        'nom' => $data['nom'],
        'email' => $data['email'],
        'mot_de_passe' => bcrypt($data['mot_de_passe']), // Sécurisation du mot de passe
    ]);

    return response()->json($utilisateur, 201); // Retourner une réponse JSON avec le nouvel utilisateur
}


    /**
     * Méthode pour se connecter.
     */
    public function seConnecter($email, $mot_de_passe)
    {
        $utilisateur = self::where('email', $email)->first();
        if ($utilisateur && Hash::check($mot_de_passe, $utilisateur->mot_de_passe)) {
            return $utilisateur;
        }
        return null;
    }

    /**
     * Méthode pour modifier le profil.
     */
    public function modifierProfil(array $data)
    {
        // Filtrer les données qui peuvent être mises à jour
        $fillableData = collect($data)->only(['nom', 'email', 'mot_de_passe'])->toArray();
    
        // Si le mot de passe est fourni, on le chiffre
        if (isset($fillableData['mot_de_passe'])) {
            $fillableData['mot_de_passe'] = bcrypt($fillableData['mot_de_passe']);
        }
    
        // Mettre à jour uniquement les champs autorisés
        return $this->update($fillableData);
    }
    

    /**
     * Méthode pour consulter le profil.
     */
    public function consulterProfil()
    {
        // Retourner toutes les données de l'utilisateur, sauf les données sensibles comme le mot de passe
        return $this->only(['id', 'nom', 'email', 'created_at', 'updated_at']);
    }
    

    protected $hidden = [
        'mot_de_passe',
    ];

    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = bcrypt($value);
    }
}


