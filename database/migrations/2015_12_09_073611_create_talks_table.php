<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateTalksTable class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateTalksTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('talks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unique();
            $this->common($table);
        });

        Schema::create('talk_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->integer('talk_id')->unsigned();
            $table->foreign('talk_id')->references('id')->on('talks');
            $table->integer('locale_id')->unsigned();
            $table->foreign('locale_id')->references('id')->on('locales');
            $table->unique(['talk_id', 'locale_id']);
            $this->common($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('talk_titles');
        Schema::drop('talks');
    }
}
