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
        Schema::table('factory_settings', function (Blueprint $table) {
            $table->foreignId('admin_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factory_settings', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['admin_id']);
            // Drop column
            $table->dropColumn('admin_id');
        });
    }
};
