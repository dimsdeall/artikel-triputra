<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indigo extends Model
{
    protected $table ='indigo';

    public function sacon()
    {
        return $this->belongsTo(Sacon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warping()
    {
        return $this->belongsTo(Warping::class);
    }

}
