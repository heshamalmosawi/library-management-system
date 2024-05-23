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
        Schema::dropIfExists('transactions');

        Schema::create('transactions', function (Blueprint $table){
            $table->id('transaction_id');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->binary('transaction_type')->comment('0: Borrow, 1: Reserve');
            $table->date('transaction_date');
            $table->date('due_date');
            $table->boolean('period_extended');
            $table->boolean('is_returned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
