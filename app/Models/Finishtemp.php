<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finishtemp extends Model
{
    protected $table = 'finishtemp';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class)->where('sacon.koreksi','>', 1);
    }

    public function greige()
    {
        return $this->belongsTo(greige::class)->where('greige.koreksi','>', 1);
    }
}
