<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateLocalesTable class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateLocalesTable extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10);
            $table->string('name', 50);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('locale_id')->unsigned();
            $table->foreign('locale_id')->references('id')->on('locales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_locale_id_foreign');
            $table->dropColumn('locale_id');
        });
        Schema::drop('locales');
    }
}
