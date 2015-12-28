<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The PreparedTalk class represents a talk prepared by a speaker.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer           $id
 * @property integer           $speaker_id
 * @property integer           $talk_id
 * @property \Carbon\Carbon    $created_at
 * @property \Carbon\Carbon    $updated_at
 * @property integer           $created_by
 * @property integer           $updated_by
 * @property integer           $circuit_id
 * @property-read \App\Circuit $circuit
 * @property-read \App\Talk    $talk
 * @property-read \App\Speaker $speaker
 * @property-read \App\User    $createdBy
 * @property-read \App\User    $updatedBy
 */
class PreparedTalk extends Model
{
    use InCongregation, InCircuit;

    // Relationships.

    /**
     * The circuit where the prepared talk belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circuit()
    {
        return $this->belongsTo('App\Circuit');
    }

    /**
     * The talk.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talk()
    {
        return $this->belongsTo('App\Talk');
    }

    /**
     * The speaker.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speaker()
    {
        return $this->belongsTo('App\Speaker');
    }

    /**
     * The user that created the prepared talk.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * The user that last updated the prepared talk.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
