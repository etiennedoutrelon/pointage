<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    protected $table = 'chantiers';

    function pointages() {
        return $this->belongsToMany(Pointage::class);
    }
}
