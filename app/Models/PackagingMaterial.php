<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagingMaterial extends Model
{
   public function demands()
    {
        return $this->hasMany(Demand::class);
    }
    protected $guarded=[];
}
