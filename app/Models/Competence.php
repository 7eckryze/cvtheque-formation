<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    //HasFactory est un trait. Ils permettent à plusieurs classes d'utiliser une même méthode
    // (problème de l'héritage multiple en PHP). Sert à peupler les tables de la base de données (jeu d'essai)
    use HasFactory;

    // Tous les modèles Eloquent (ORM) sont protégés par défaut contre les vulnérabilités d'assignation de masse
    // (envoie d'un tableau au modèle en une seule fois)

    //https://laravel.com/docs/9.x/eloquent#mass-assignment-exceptions
    protected $fillable = ['intitule', 'description'];




}
