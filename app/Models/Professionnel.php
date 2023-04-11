<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'cp',
        'ville',
        'telephone',
        'email',
        'naissance',
        'formation',
        'domaine',
        'pdf',
        'source',
        'observation',
        'metier_id',
    ];

    /**
     * Un professionnel ne possède qu'un seul Métier (BelongsTo)
     * La méthode métier (singulier) permet de rechercher le métier du professionnel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function metier()
    {
        return $this->belongsTo(Metier::class);
    }

    /**
     * Récupération de toutes les compétences d'un professionnel
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competences()
    {
        return $this->belongsToMany(Competence::class)->withTimestamps();
    }
}
