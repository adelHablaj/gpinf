<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    use HasFactory;

    public function etab()
    {
        return $this->hasMany(Etab::class, 'cd_netab','id' );
    }
}
