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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id'); // secondary key
            $table->integer('role_type'); // [1: Admin, 2: Faculty, 3: Checker]
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            $table->text('course_program')->nullable();
            $table->date('dob')->nullable(); // alternative $table->string('dob');
            $table->integer('age')->nullable();
            $table->text('address')->nullable();
            $table->time('last_login')->nullable();
            $table->string('status')->default('offline');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
