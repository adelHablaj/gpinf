<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Eleve extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tuteurs()
    {
        return  $this->belongsToMany(Tuteur::class)->withTimestamps()->withPivot(['id', 'tutorrelation', 'tutortype', 'paietype']);
    }
    // public function mere()
    // {
    //     return  $this->belongsTo(Tuteur::class, 'mere_id');
    // }
    // public function pere()
    // {
    //     return  $this->belongsTo(Tuteur::class, 'pere_id');
    // }
    // public function respPaye()
    // {
    //     return  $this->belongsTo(Tuteur::class, 'resp_paye_id');
    // }

    public function niveau()
    {
        return  $this->belongsTo(Niveau::class);
    }
    public function scolarite()
    {
        return  $this->hasMany(Scolarite::class);
    }
    public function paiement()
    {
        return  $this->hasMany(Paiement::class);
    }
    public function detailpaiement()
    {
        return  $this->hasMany(DetailPaiement::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('profile')
        ->fit(Manipulations::FIT_CROP, 120, 120);

        $this->addMediaConversion('tiny')
        ->fit(Manipulations::FIT_CROP, 30, 30);
    }

}
