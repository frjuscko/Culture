<?php

namespace App\Models;
use PragmaRX\Google2FA\Google2FA;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nom',
        'prenom',
        'photo',
        'statut',
        'sexe',
        'langue',
        'region',
        'email',
        'password',
        'role',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token'
    ];

    protected $casts = [
        'two_factor_enabled' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

    }
    
    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function subscription()
{
    return $this->hasOne(Abonnement::class);
}

public function hasActiveSubscription()
{
    return $this->subscription 
        && $this->subscription->status === 'active'
        && $this->subscription->expires_at > now();
}


    // Relation avec la table roles
    public function roleinfo()
    {
        return $this->belongsTo(Role::class, 'role');
    }

    // Relation avec la table regions
    public function regioninfo()
    {
        return $this->belongsTo(Region::class, 'region');
    }

    // Relation avec la table langues
    public function langueinfo()
    {
        return $this->belongsTo(Langue::class, 'langue');
    }

    // Relation avec les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'auteur');
    }

    // Relation avec les commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'utilisateur');
    }

    // Méthode pour obtenir la classe CSS du statut
    public function getStatutClasse()
    {
        return str_replace(' ', '_', strtolower($this->statut));
    }

    // Méthode pour vérifier si l'utilisateur est administrateur
    public function isAdmin()
    {
        if (is_numeric($this->role)) {
            $this->load('roleinfo');
        }

        return $this->roleinfo && $this->roleinfo->libelle === 'Administrateur';
    }

    // Méthode pour vérifier si l'utilisateur est modérateur
    public function isModerator()
    {
        if (is_numeric($this->role)) {
            $this->load('roleinfo');
        }

        return $this->roleinfo && $this->roleinfo->libelle === 'Modérateur';
    }

    // Méthode pour vérifier si l'utilisateur est contributeur
    public function isContributeur()
    {
        if (is_numeric($this->role)) {
            $this->load('roleinfo');
        }

        return $this->roleinfo && $this->roleinfo->libelle === 'Contributeur';
    }

    // Méthode pour vérifier si l'utilisateur est lecteur
    public function isLecteur()
    {
        if (is_numeric($this->role)) {
            $this->load('roleinfo');
        }

        return $this->roleinfo && $this->roleinfo->libelle === 'Lecteur';
    }

}
