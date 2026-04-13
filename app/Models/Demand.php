<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'name', 'status', 'requested_by', 'remarks', 'date_requested', 'date_approved'
    ];

    // Relation to medicine table (for backward compatibility)
    public function material()
    {
        return $this->belongsTo(Product::class, 'medicine_id');
    }

    // Demand relates to stock (for backward compatibility)
    public function stock()
    {
        return $this->belongsTo(Product::class, 'medicine_id');
    }

    // Many-to-Many relationship with Products via demand_items
    public function products()
    {
        return $this->belongsToMany(Product::class, 'demand_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Get all demand items
    public function items()
    {
        return $this->hasMany(DemandItem::class);
    }

    // Get total quantity across all items
    public function getTotalQuantityAttribute()
    {
        return $this->items()->sum('quantity');
    }
}






