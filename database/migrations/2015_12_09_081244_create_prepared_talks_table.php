<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreatePreparedTalksTable class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreatePreparedTalksTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prepared_talks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('speaker_id')->unsigned();
            $table->integer('talk_id')->unsigned();
            $table->integer('congregation_id')->unsigned();
            $table->foreign('speaker_id')->references('id')->on('speakers');
            $table->foreign('talk_id')->references('id')->on('talks');
            $table->foreign('congregation_id')->references('id')->on('congregations');
            $this->common($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('prepared_talks');
    }
}
