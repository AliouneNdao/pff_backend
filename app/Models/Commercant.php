<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commercant extends Model
{
    use HasFactory;

    protected $fillable = [
        'acheter_en_gros',
        'stock',
    ];
}

