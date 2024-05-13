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
        Schema::table('payrolls', function (Blueprint $table) {
            $table->foreignId('payrollPeriod_id')->constrained('payroll_periods')->after('id');
            $table->foreignId('employee_id')->constrained('employees')->after('payrollPeriod_id');
        });
    }

    public function down()
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropForeign(['payrollPeriod_id']);
            $table->dropForeign(['employee_id']);
        });
    }
};
