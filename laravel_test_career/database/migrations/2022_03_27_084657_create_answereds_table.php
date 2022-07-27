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
        Schema::create('answereds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tested_id');
            // $table->unsignedBigInteger("quest_id");
            $table->integer("numbering");
            $table->string("liter");
            // $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
            $table->foreign('tested_id')->references('id')->on('testeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostics');
    }
};
