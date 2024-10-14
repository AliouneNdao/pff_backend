<?php
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ConsommateurController;
use App\Http\Controllers\CommercantController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AgriculteurController;

// Routes pour les utilisateurs
Route::post('/utilisateurs/inscrire', [UtilisateurController::class, 'inscrire']);
Route::post('/utilisateurs/connexion', [UtilisateurController::class, 'connexion']);
Route::get('/utilisateurs/{id}/profil', [UtilisateurController::class, 'consulterProfil']);
Route::put('/utilisateurs/{id}/modifier', [UtilisateurController::class, 'modifierProfil']);
Route::delete('admin/utilisateurs/{id}', [UtilisateurController::class, 'supprimer_utilisateur'])->middleware(['auth:api', 'is_admin']);

// Routes pour les consommateurs
Route::post('consommateur/ajouter_panier', [ConsommateurController::class, 'ajouter_panier']);
Route::post('consommateur/passer_commande', [ConsommateurController::class, 'passer_commande']);
Route::post('consommateur/laisser_evaluation', [ConsommateurController::class, 'laisser_evaluation']);

// Routes pour les commerçants
Route::post('commercant/acheter_en_gros', [CommercantController::class, 'acheter_en_gros']);
Route::post('commercant/gerer_stock', [CommercantController::class, 'gerer_stock']);

// Routes pour les produits
Route::get('produits/{id}', [ProduitController::class, 'consulter_details']);

// Routes pour les commandes
Route::get('commandes/{id}', [CommandeController::class, 'consulter_details']);
Route::get('commandes/{id}/suivre', [CommandeController::class, 'suivre_commande']);

// Routes pour les évaluations
Route::get('evaluations/consommateur/{id}', [EvaluationController::class, 'consulter_evaluation']);

// Routes pour les agriculteurs
Route::post('agriculteurs', [AgriculteurController::class, 'ajouter']);
Route::put('agriculteurs/{id}', [AgriculteurController::class, 'modifier']);
Route::get('agriculteurs/{id}/commandes', [AgriculteurController::class, 'consulter_commande']);
