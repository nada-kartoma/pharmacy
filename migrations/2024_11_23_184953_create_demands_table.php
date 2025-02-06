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
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicine_id')->constrained('medicines')->onDelete('cascade'); // ربط مع جدول الأدوية
            $table->integer('count'); 
            $table->string('status')->default('waiting accept'); 
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade'); // ربط مع جدول الأدوية
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
