<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = [
        'stockable_id',
        'stockable_type',
        'medicine_id',
        'quantity',
        'batch_no',
        'expiry_date',
        'status',
    ];
    
    public function stockable()
    {
        return $this->morphTo();
    }

    protected $casts = [
        'expiry_date' => 'date',
    ];

    // Relationship: Stock → Demands
    public function demands()
    {
        return $this->hasMany(Demand::class, 'medicine_id');
    }
public function stock()
{
    return $this->belongsTo(Stock::class, 'medicine_id');
}

public function medicine()
{
    return $this->belongsTo(Product::class, 'medicine_id');
}







}
