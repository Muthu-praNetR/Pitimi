<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreatePreparedTalksTable class.
 *
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
            $table->integer('talk_subject_id')->unsigned();
            $table->foreign('speaker_id')->references('id')->on('speakers');
            $table->foreign('talk_subject_id')->references('id')->on('talk_subjects');
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
