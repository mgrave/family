<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Airlock\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Devuelve los movimientos de tesoreria
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treasuries()
    {
        return $this->hasMany(Treasury::class, 'treasury_id');
    }

    /**
     * Devuelve los socions de negocios que creo
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function businessPartners()
    {
        return $this->hasMany(BusinessPartner::class, 'business_partner_id');
    }

}
