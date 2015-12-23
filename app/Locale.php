<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Locale class represents a language.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer $id
 * @property string $code
 * @property string $name
 */
class Locale extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
