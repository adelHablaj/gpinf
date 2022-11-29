<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'all'
    ];

    public function niveau()
    {
        return  $this->belongsTo(Niveau::class);
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
