<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weaving extends Model
{
    protected $table = 'weaving';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class)->where('sacon.koreksi','>', 1);
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
