<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    public function province()
    {
        return $this->belongsTo(Province::class, 'cd_prov', 'id');
    }

    public function etab()
    {
        return $this->hasMany(Etab::class, 'cd_com', 'id');
    }
}
