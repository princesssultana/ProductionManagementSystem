<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'stockable_type', 'stockable_id', 'quantity', 
        'batch_no', 'expiry_date', 'status'
    ];

    protected $dates = ['expiry_date'];

    public function stockable()
    {
        return $this->morphTo();
    }

    public function demands()
    {
        return $this->morphMany(Demand::class, 'stockable');
    }
}
