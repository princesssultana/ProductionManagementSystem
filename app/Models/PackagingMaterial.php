<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagingMaterial extends Model
{
    protected $guarded = [];

    public function demands()
    {
        return $this->hasMany(Demand::class);
    }

    // Many-to-Many relationship with Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_packaging_material')
                    ->withPivot('quantity_per_unit')
                    ->withTimestamps();
    }
}
