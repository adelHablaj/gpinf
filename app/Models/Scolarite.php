<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scolarite extends Model
{
    use HasFactory;

    public function anneescolaire()
    {
        return  $this->belongsTo(Anneescolaire::class);
    }
    public function niveau()
    {
        return  $this->belongsTo(Niveau::class);
    }
    public function eleve()
    {
        return  $this->belongsTo(Eleve::class);
    }

}
