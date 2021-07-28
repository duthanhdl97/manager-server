<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_details', function (Blueprint $table) {
            $table->string('id', 26);
            $table->string('employee_id', 26)->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_other')->nullable();
            $table->string('email')->nullable();
            $table->string('yahoo')->nullable();
            $table->string('skype')->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->string('village')->nullable();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')->useCurrent();
            $table->string('created_by');
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_details');
    }
}
