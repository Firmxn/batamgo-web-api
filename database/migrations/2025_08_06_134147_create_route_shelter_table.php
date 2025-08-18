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
        Schema::create('route_shelter', function (Blueprint $table) {
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
            $table->foreignId('shelter_id')->constrained('shelters')->onDelete('cascade');
            $table->primary(['route_id', 'shelter_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_shelter');
    }
};
