<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessPartner extends Model
{

    public $table = 'business_partner';

    public $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'status',
    ];

    /**
     * Devuelve el usuario que creo el socio de negocio
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Devuelve los movimientos de tesoreria
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treasuries()
    {
        return $this->hasMany(Treasury::class, 'treasury_id');
    }

}
