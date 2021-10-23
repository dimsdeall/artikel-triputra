<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sacon extends Model
{
  protected $table = 'sacon';


  // public function users()
  // {
  //     return $this->belongsToMany('App\User', 'sacon', 'user_id', 'id');
  // }

  public function users()
    {
        // return $this->belongsToMany(User::class);
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

  public function laporan()
  {
      return $this->hasMany(Warping::class, 'sacon_id', 'id');
  }
  
}
