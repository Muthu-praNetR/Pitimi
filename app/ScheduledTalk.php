<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The ScheduledTalk class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer                $id
 * @property integer                $congregation_id
 * @property integer                $speaker_id
 * @property integer                $prepared_talk_id
 * @property string                 $scheduled_at
 * @property \Carbon\Carbon         $created_at
 * @property \Carbon\Carbon         $updated_at
 * @property integer                $created_by
 * @property integer                $updated_by
 * @property-read \App\Congregation $congregation
 * @property-read \App\Speaker      $speaker
 * @property-read \App\PreparedTalk $preparedTalk
 * @property-read \App\User         $createdBy
 * @property-read \App\User         $updatedBy
 */
class ScheduledTalk extends Model
{
    // Relationships.

    public function congregation()
    {
        return $this->belongsTo('App\Congregation');
    }

    public function speaker()
    {
        return $this->belongsTo('App\Speaker');
    }

    public function preparedTalk()
    {
        return $this->belongsTo('App\PreparedTalk');
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
