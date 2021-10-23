<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
    protected $table = 'finish';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class)->where('sacon.koreksi','>', 1);
    }

    public function greige()
    {
        return $this->belongsTo(greige::class)->where('greige.koreksi','>', 1);
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
