<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    protected $table = 'pointages';

    function user() {
        return $this->belongsTo(User::class);
    }

    function chantiers() {
        return $this->belongsToMany(Chantier::class);
    }
}
