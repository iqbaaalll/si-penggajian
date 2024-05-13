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
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('bonus')->after('salaryMonth');
            $table->integer('thr')->after('bonus');
        });
    }

    public function down()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropColumn('bonus');
            $table->dropColumn('thr');
        });
    }
};
