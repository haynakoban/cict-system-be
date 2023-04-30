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
            $table->string('user_employee_id'); // secondary key
            $table->integer('user_role_type'); // [1: Admin, 2: Faculty, 3: Checker]
            $table->string('user_first_name');
            $table->string('user_middle_name')->nullable();
            $table->string('user_last_name');
            $table->string('user_username');
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->string('user_position')->nullable();
            $table->text('user_course_program')->nullable();
            $table->date('user_dob')->nullable(); // alternative $table->string('dob');
            $table->integer('user_age')->nullable();
            $table->text('user_address')->nullable();
            $table->time('user_last_login')->nullable();
            $table->string('user_status')->default('offline');
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
