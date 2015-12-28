<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Circuit class.
 *
 * @package App
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer                                                            $id
 * @property integer                                                            $number
 * @property \Carbon\Carbon                                                     $created_at
 * @property \Carbon\Carbon                                                     $updated_at
 * @property integer                                                            $created_by
 * @property integer                                                            $updated_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Congregation[]  $congregations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Speaker[]       $speakers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PreparedTalk[]  $preparedTalks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ScheduledTalk[] $scheduledTalks
 * @property-read \App\User                                                     $createdBy
 * @property-read \App\User                                                     $updatedBy
 */
class Circuit extends Model
{
    // Relationships.

    public function congregations()
    {
        return $this->hasMany('App\Congregation');
    }

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function preparedTalks()
    {
        return $this->hasMany('App\PreparedTalk');
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
