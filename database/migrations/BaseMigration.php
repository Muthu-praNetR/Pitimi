<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * The BaseMigration class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class BaseMigration extends Migration
{
    /**
     * Add common columns to a table blueprint.
     *
     * @param Blueprint $table    The table blueprint.
     * @param bool      $nullable Indicate if the columsn are nullables.
     */
    protected function common(Blueprint $table, $nullable = false)
    {

        // Add common columns
        $table->timestamps();
        if ($nullable) {
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
        } else {
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
        }

        // Add common relationships.
        $table->foreign('created_by')->references('id')->on('users');
        $table->foreign('updated_by')->references('id')->on('users');
    }
}
