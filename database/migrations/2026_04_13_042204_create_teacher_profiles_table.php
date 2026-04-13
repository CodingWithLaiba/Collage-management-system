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
        Schema::create('teacher_profiles', function (Blueprint $table) {
            $table->id();
             $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); 
            $table->text('address')->nullable(); 
            $table->string('father_name')->nullable(); 
            $table->string('mother_name')->nullable(); 
            $table->string('emergency_contact')->nullable(); 
            $table->string('blood_group')->nullable(); 
            $table->string('profile_picture')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_profiles');
    }
};
