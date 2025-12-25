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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->after('password');
            $table->string('role')->after('dob');
            $table->string('phone')->after('role');
            $table->string('image')->after('remember_token');
            $table->bigInteger('city')->after('phone');
            $table->bigInteger('country')->after('city');
            $table->string('state')->after('country');
            $table->string('pincode')->after('state');
            $table->foreign('city')->references('id')->on('city_tbl')->onDelete('cascade');
            $table->foreign('country')->references('id')->on('country_tbl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
