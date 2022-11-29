<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etab extends Model
{
    use HasFactory;

    // protected $primaryKey = 'cd_etab';

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'cd_com', 'id');
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class, 'cd_netab', 'id');
    }


}
