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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('basicSalary');
            $table->integer('bonus')->nullable();
            $table->integer('thr')->nullable();
            $table->integer('brutoSalary');
            $table->integer('taxAmount');
            $table->integer('bpjsKesAmount');
            $table->integer('bpjsTkAmount');
            $table->integer('pensionAmount')->nullable();
            $table->integer('debtAmount')->nullable();
            $table->integer('netSalary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
