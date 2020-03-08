<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $table = 'bank';

    public $fillable = [
        'bank_service_id',
        'name',
        'balance',
        'status'
    ];

    /**
     * Devuelve el servicio al que pertenece el banco
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankService()
    {
        return $this->belongsTo(BankSercice::class, 'bank_service_id');
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
