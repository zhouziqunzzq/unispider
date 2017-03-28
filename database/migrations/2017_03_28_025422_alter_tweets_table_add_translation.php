<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTweetsTableAddTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->text('trans_zh')->nullable();
            $table->string('trans_zh_author')->nullable();
            $table->text('trans_en')->nullable();
            $table->string('trans_en_author')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropColumn('trans_zh');
            $table->dropColumn('trans_zh_author');
            $table->dropColumn('trans_en');
            $table->dropColumn('trans_en_author');
        });
    }
}
