<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateCongregationsTable class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateCongregationsTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('congregations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_group');
            $table->datetime('public_meeting_at');
            $this->common($table);
        });

        Schema::create('congregation_user', function (Blueprint $table) {
            $table->integer('congregation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('congregation_id')->references('id')->on('congregations');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('congregation_user');
        Schema::drop('congregations');
    }
}
