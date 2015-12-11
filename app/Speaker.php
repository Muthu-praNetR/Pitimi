<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Speaker class represents who present a talk.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class Speaker extends Model
{
    // Relationships.

    public function congregation()
    {
        return $this->belongsTo('App\Congregation');
    }

    public function scheduledTalks()
    {
        return $this->hasMany('App\ScheduleTalk');
    }

    public function preparedTalks()
    {
        return $this->hasMany('App\PreparedTalk');
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
