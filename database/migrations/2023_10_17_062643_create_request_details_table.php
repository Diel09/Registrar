<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_details', function (Blueprint $table) {
            $table->id();
            $table->integer('stud_no');
            $table->integer('alumni_id');
            $table->string('name');
            $table->string('email');
            $table->string('degree');
            $table->string('cont_no');
            $table->float('total_amount');
            $table->tinyInteger('req_status');
            $table->integer('referencce_no');
            $table->integer('OR_no');
            $table->string('remarks');
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
        Schema::dropIfExists('request_details');
    }
}
