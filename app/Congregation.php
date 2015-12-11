<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Congregation class represents the venue to present a talk.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class Congregation extends Model
{
    // Relationships.

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function scheduledTalks()
    {
        return $this->hasMany('App\ScheduledTalk');
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
