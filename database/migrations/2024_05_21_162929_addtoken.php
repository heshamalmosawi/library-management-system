<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'remember_token')) {
            Schema::table('users', function (Blueprint $table) {
            $table->rememberToken();
            });
        }
        if (!Schema::hasColumn('staff', 'remember_token')) {
            Schema::table('staff', function (Blueprint $table) {
            $table->rememberToken();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
    
};
