<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateScheduledTalksTable class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateScheduledTalksTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('scheduled_talks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('congregation_id')->unsigned();
            $table->foreign('congregation_id')->references('id')->on('congregations');
            $table->integer('speaker_id')->unsigned();
            $table->foreign('speaker_id')->references('id')->on('speakers');
            $table->integer('prepared_talk_id')->unsigned();
            $table->foreign('prepared_talk_id')->references('id')->on('prepared_talks');
            $table->datetime('scheduled_at');
            $this->common($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('scheduled_talks');
    }
}
