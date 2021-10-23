<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warping extends Model
{
    protected $table = 'warping';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class)->where('sacon.koreksi','>', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indigo()
    {
        return $this->hasOne(Indigo::class)->where('indigo.koreksi', 2);
    }

    public function indigo1()
    {
        return $this->hasOne(Indigo::class, 'foreign_key', 'local_key');
    }
}
