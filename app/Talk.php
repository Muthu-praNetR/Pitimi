<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Talk class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class Talk extends Model
{
    // Relationships.

    public function subjects()
    {
        $this->hasMany('App\TalkSubject');
    }
}
