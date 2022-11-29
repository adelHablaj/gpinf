<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return  $this->belongsTo(Role::class);
    }
    public function eleve()
    {
        return  $this->hasMany(Eleve::class);
    }
    public function tuteur()
    {
        return  $this->hasMany(Tuteur::class);
    }
    public function paiement()
    {
        return  $this->hasMany(Paiement::class);
    }
    public function preinscription()
    {
        return  $this->hasMany(Preinscription::class);
    }
    public function niveau()
    {
        return  $this->hasMany(Niveau::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('profile')
        ->fit(Manipulations::FIT_CROP, 120, 120);

        $this->addMediaConversion('tiny')
        ->fit(Manipulations::FIT_CROP, 30, 30);
    }
}
