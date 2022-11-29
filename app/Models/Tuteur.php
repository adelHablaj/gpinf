<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuteur extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Eleves()
    {
        return  $this->belongsToMany(Eleve::class)->withTimestamps()->withPivot(['tutorrelation', 'tutortype']);
    }

    // public function pereEleves()
    // {
    //     return  $this->hasMany(Eleve::class, 'pere_id');
    // }
    // public function mereEleves()
    // {
    //     return  $this->hasMany(Eleve::class, 'mere_id');
    // }
    // public function respPayeEleves()
    // {
    //     return  $this->hasMany(Eleve::class, 'resp_paye_id');
    // }

    public function nationalite()
    {
        return  $this->belongsTo(Nationalite::class);
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function paiement()
    {
        return  $this->hasMany(Paiement::class);
    }
}
