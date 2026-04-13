<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandItem extends Model
{
    protected $fillable = ['demand_id', 'product_id', 'quantity'];

    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
