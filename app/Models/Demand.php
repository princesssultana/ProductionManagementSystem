<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = [
        'medicine_id', 'name', 'qty', 'status', 'approved_qty', 'date_approved'
    ];

    // Relation to medicine table
    public function material()
    {
        return $this->belongsTo(Product::class, 'medicine_id');
    }
// Demand.php
public function stock()
{
    return $this->belongsTo(Product::class, 'medicine_id'); // or Medicine::class
}




}






