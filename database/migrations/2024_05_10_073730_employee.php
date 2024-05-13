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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('initialName')->unique();
            $table->date('startWork');
            $table->date('birth');
            $table->integer('salaryMonth');
            $table->string('bankAccount');
            $table->string('taxStatus');
            $table->string('nip')->nullable();
            $table->string('nik');
            $table->string('npwp')->nullable();
            $table->string('bpjsKes')->nullable();
            $table->string('bpjsTk')->nullable();
            $table->string('phoneNumber');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
