<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateSpeakersTable class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateSpeakersTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('congregation_id')->unsigned();
            $table->foreign('congregation_id')->references('id')->on('congregations');
            $this->common($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('speakers');
    }
}
