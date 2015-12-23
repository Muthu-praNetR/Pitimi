<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Congregation class represents the venue to present a talk.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer $id
 * @property string $name
 * @property boolean $is_group
 * @property \Carbon\Carbon $public_meeting_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Speaker[] $speakers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ScheduledTalk[] $scheduledTalks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read \App\User $createdBy
 * @property-read \App\User $updatedBy
 */
class Congregation extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'public_meeting_at'];

    // Relationships.

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function scheduledTalks()
    {
        return $this->hasMany('App\ScheduledTalk');
    }

    public function users()
    {
        return $this->hasMany('App\User');
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
