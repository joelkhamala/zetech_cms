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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('department_id')->constrained();
            $table->foreignId('program_id')->constrained();
            $table->string('department')->default('not cleared');
            $table->string('library')->default('not cleared');
            $table->string('finance')->default('not cleared');
            $table->string('gown')->default('not picked');
            $table->string('certTrans')->default('not picked');
            $table->string('gown_id')->default('0');
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
        Schema::dropIfExists('clearances');
    }
};
