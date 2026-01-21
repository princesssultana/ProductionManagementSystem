<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Demand
    public function demands()
    {
        return $this->hasMany(Demand::class, 'medicine_id'); // link via medicine_id
    }

    // Many-to-Many relationship with PackagingMaterial
    public function packagingMaterials()
    {
        return $this->belongsToMany(PackagingMaterial::class, 'product_packaging_material')
                    ->withPivot('quantity_per_unit')
                    ->withTimestamps();
    }
}










