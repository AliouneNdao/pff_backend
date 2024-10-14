<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id(); // Colonne id (int)
            $table->string('nom'); // Colonne nom (string)
            $table->string('email')->unique(); // Colonne email (string)
            $table->string('password'); // Colonne mot de passe (string)
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }
    
};
