<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'description', 'slug'];

    /**
     * Un métier est associé à plusieurs professionnels (HasMany)
     * La méthode s'écrit au pluriel
     * Cette méthode récupère tous les professionnels partageant le même métier
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professionnels()
    {
        return $this->hasMany(Professionnel::class);
    }


}


