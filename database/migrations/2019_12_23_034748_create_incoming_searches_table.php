<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_searches', function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->unsignedBigInteger('post_id');
						$table->foreign('post_id')->references('id')->on('posts');
						$table->string('search');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_searches');
    }
}
