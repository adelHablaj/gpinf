<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected   $guarded = [];

    public function eleve()
    {
        return  $this->belongsTo(Eleve::class);
    }
    public function tuteur()
    {
        return  $this->belongsTo(Tuteur::class);
    }
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
