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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relation to Medicine or PackagingMaterial
            $table->morphs('stockable'); // creates stockable_id + stockable_type

            $table->integer('quantity')->default(0);
            $table->string('batch_no')->nullable();
            $table->date('expiry_date')->nullable();

            // status can be 'available' or 'expired'
            $table->enum('status', ['available', 'expired'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
