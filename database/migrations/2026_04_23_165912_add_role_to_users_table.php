<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'teacher', 'student'])->default('student');
            }
            if (!Schema::hasColumn('users', 'student_id')) {
                $table->foreignId('student_id')->nullable()->constrained()->onDelete('set null');
            }
            if (!Schema::hasColumn('users', 'teacher_id')) {
                $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'student_id', 'teacher_id']);
        });
    }
};
