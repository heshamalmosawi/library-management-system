<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('returned_books', function (Blueprint $table){
            $table->unsignedBigInteger('transaction_id');
            $table->date('return_date');
            $table->double('return_fees', 6, 3);
            $table->timestamps();
        });
        
        DB::unprepared('
            CREATE TRIGGER update_transactions AFTER INSERT ON returned_books
            FOR EACH ROW
                BEGIN
                    UPDATE transactions
                    SET is_returned = 1
                    WHERE transaction_id = NEW.transaction_id;
                END;
        ');

        DB::unprepared('
            CREATE TRIGGER update_books AFTER INSERT ON returned_books
            FOR EACH ROW
                BEGIN
                    UPDATE books
                    SET available_copies = available_copies + 1
                    WHERE book_id = (SELECT book_id FROM transactions WHERE transaction_id = NEW.transaction_id);
                END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returned_books');
    }
};
