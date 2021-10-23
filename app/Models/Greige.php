<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Greige extends Model
{
    protected $table = 'greige';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class)->where('sacon.koreksi','>', 1);
    }

    public function weaving()
    {
        return $this->belongsTo(Weaving::class)->where('weaving.koreksi','>', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'opr', 'id');
    }
}
