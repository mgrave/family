<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{

    public $table = 'treasury';

    public $fillable = [
        'user_id',
        'business_partner_id',
        'bank_id',
        'type',
        'amount',
        'status'
    ];

    /**
     * Devuelve el usuario responsable
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Devuelve el Socio de Negocio responsable
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function businessPartner()
    {
        return $this->belongsTo(BusinessPartner::class, 'business_partner');
    }

    /**
     * Devuelve el banco donde pertenece
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

}
