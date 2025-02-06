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
        Schema::create('previews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demand_id')->constrained('demands')->onDelete('cascade'); 
            $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade'); 
            $table->timestamp('last_sent_at')->nullable();
            $table->time('time')->nullable(); 
            $table->string('preview')->nullable(); 
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('pharmacist_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('previews');
    }
};
