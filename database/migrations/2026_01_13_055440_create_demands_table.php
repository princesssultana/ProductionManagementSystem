<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qty');
            $table->foreignId('medicine_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->integer('approved_qty')->nullable();
            $table->string('status')->default('Pending');
            $table->string('requested_by')->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_requested')->nullable();
            $table->date('date_approved')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
