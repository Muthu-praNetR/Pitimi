<?php

use Illuminate\Database\Schema\Blueprint;

/**
 * The CreateCircuitsTable class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CreateCircuitsTable extends BaseMigration
{
    protected $tenanted_tables = ['congregations', 'speakers', 'prepared_talks', 'scheduled_talks'];

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->unsigned();
            $this->common($table);
        });

        foreach ($this->tenanted_tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->integer('circuit_id')->unsigned();
                $table->foreign('circuit_id')->references('id')->on('circuits');
            });
        }
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        foreach ($this->tenanted_tables as $table_name) {
            Schema::table($table_name, function (Blueprint $table) use ($table_name) {
                $table->dropForeign($table_name . '_circuit_id_foreign');
            });
        }

        Schema::drop('circuits');
    }
}
