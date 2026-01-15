<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    //protected $table = 'products';

  // protected $fillable = [
   // 'medicine_name', 'batch_no', 'quantity', 'production_date', 
    //'expiry_date', 'image', 'description', 'status'];
 protected $guarded = [];
 public function demands()
{
    return $this->hasMany(Demand::class, 'medicine_id'); // link via medicine_id
}
 







}




