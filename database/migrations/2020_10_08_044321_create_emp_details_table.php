<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('emp_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('skills');
            $table->string('location');
            $table->unsignedInteger('deleted_at')->default('NULL');
            $table->dateTime('deleted_at')->default('NULL');
            $table->enum('status',['0','1'])->comment("0 = 'Inactive',1 ='Active'")->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_details');
    }
}
