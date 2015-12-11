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

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
