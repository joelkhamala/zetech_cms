<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gowns', function (Blueprint $table) {
            $table->id('gown_id');
            $table->string('email');
            $table->integer('gown_serial_number');
            $table->string('condition')->default('good');;
            $table->string('size')->default('small');
            $table->string('picked')->default('not picked');
            $table->string('returned')->default('returned');
            /* For Creating Current Timestamp */
            $table->timestamp('created_at')->useCurrent();
            /* For Updating */
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gowns');
    }
};
