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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('name', 25);
            $table->string('email', 20)->unique();
            $table->unsignedInteger('contact_no');
            $table->string('hashed_pass', 255);
            $table->boolean('is_admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
