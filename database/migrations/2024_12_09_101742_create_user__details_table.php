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
        Schema::create('user__details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->longText('attachment')->nullable();
            $table->string('department')->nullable();
            $table->string('course')->nullable();
            $table->string('rollno')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('enrollment')->nullable();
            $table->string('branch')->nullable();
            $table->string('category')->nullable();
            $table->string('batch')->nullable();
            $table->string('address')->nullable();
            $table->string('college_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('permanent_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user__details');
    }
};
