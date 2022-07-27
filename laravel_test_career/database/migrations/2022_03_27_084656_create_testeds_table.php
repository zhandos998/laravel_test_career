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
        Schema::create('testeds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("test_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Schema::table('quests', function (Blueprint $table) {
        //     $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
        // });
        // Schema::table('answers', function (Blueprint $table) {
        //     $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
        // });
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
