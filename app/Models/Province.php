<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public function commune()
    {
        return $this->hasMany(Commune::class, 'cd_prov', 'id');
    }

    public function etabs()
    {
        return $this->hasManyThrough(Etab::class, Commune::class, 'cd_prov', 'cd_com', 'id', 'id');
    }

}
