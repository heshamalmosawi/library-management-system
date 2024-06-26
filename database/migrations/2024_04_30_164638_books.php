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
        Schema::create('books', function (Blueprint $table){
            $table->id('book_id');
            $table->string('ISBN', 13);
            $table->string('title', 50);
            $table->string('author', 40);
            $table->string('bookcover_url', 255);
            $table->string('publisher', 20);
            $table->string('category', 30);
            $table->date('publish_date');
            $table->string('abstract', 255);
            $table->unsignedInteger('available_copies');
            $table->unsignedInteger('total_copies');
            $table->string('location');
            $table->unsignedInteger('numOfPages');
            $table->boolean('is_archived');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
