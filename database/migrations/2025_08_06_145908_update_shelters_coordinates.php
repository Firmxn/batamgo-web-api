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
     Schema::table('shelters', function (Blueprint $table) {
        $table->decimal('latitude', 14, 10)->change();
        $table->decimal('longitude', 14, 10)->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('shelters', function (Blueprint $table) {
        // Kita kembalikan ke nilai awal jika diperlukan
        $table->decimal('latitude', 10, 8)->change();
        $table->decimal('longitude', 11, 8)->change();
    });
    }
};
