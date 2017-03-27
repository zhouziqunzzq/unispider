<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin_id');
            $table->index('origin_id');
            $table->string('origin_created_at');
            //$table->char('lang', 5);
            //$table->bigInteger('favorite_count');
            //$table->bigInteger('retweet_count');
            //$table->string('source');
            $table->text('text');
            $table->text('jsondata');
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
        Schema::dropIfExists('tweets');
    }
}
