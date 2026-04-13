<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
<<<<<<< HEAD

   {
    
    protected $guarded=[];
}
 




=======
{
    protected $guarded = [];
>>>>>>> e3989e50dde883befeaef22580326c02260ff211

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

<<<<<<< HEAD

=======
    // Many-to-Many relationship with PackagingMaterial
    public function packagingMaterials()
    {
        return $this->belongsToMany(PackagingMaterial::class, 'product_packaging_material')
                    ->withPivot('quantity_per_unit')
                    ->withTimestamps();
    }
}
>>>>>>> e3989e50dde883befeaef22580326c02260ff211










