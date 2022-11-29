<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    public function eleve()
    {
        return  $this->hasMany(Eleve::class);
    }
    public function preinscription()
    {
        return  $this->hasMany(Preincription::class);
    }
    public function scolarite()
    {
        return  $this->hasMany(Scolarite::class);
    }
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
