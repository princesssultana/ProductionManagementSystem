<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->string('medicine_name'); 
            $table->string('batch_no'); 
            $table->integer('quantity'); 
            $table->date('production_date'); 
            $table->date('expiry_date'); 
            $table->string('image')->nullable(); 
            $table->text('description')->nullable(); 
            $table->enum('status', ['pending','completed','cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
