<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSercice extends Model
{
    public $table = 'bank_service';

    public $fillable = [
        'name',
        'status'
    ];

    /**
     * Develve todos los bancos relacionas al servicio
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function banks()
    {
        return $this->hasMany(Bank::class, 'bank_id');
    }

}
