<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The PreparedTalk class represents a talk prepared by a speaker.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer $id
 * @property integer $speaker_id
 * @property integer $talk_subject_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property-read \App\TalkSubject $talkSubject
 * @property-read \App\Speaker $speaker
 * @property-read \App\User $createdBy
 * @property-read \App\User $updatedBy
 */
class PreparedTalk extends Model
{
    // Relationships.

    public function talkSubject()
    {
        return $this->belongsTo('App\TalkSubject');
    }

    public function speaker()
    {
        return $this->belongsTo('App\Speaker');
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
