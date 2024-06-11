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
        Schema::create('deleted_transcripts', function (Blueprint $table) {
            $table->bigIncrements('transcript_id');
            $table->string('email');
            $table->string('transcript_serial_number');
            $table->string('file_name');
            $table->integer('department_id');
            $table->integer('program_id');
            $table->string('retrieved')->default('not retrieved');
            $table->timestamp('created_at')->useCurrent();
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
        Schema::dropIfExists('deleted_transcripts');
    }
};
