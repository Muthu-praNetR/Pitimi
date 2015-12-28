<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * The ScheduledTalk class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer                $id
 * @property integer                $congregation_id
 * @property integer                $prepared_talk_id
 * @property string                 $scheduled_at
 * @property \Carbon\Carbon         $created_at
 * @property \Carbon\Carbon         $updated_at
 * @property integer                $created_by
 * @property integer                $updated_by
 * @property-read \App\Congregation $congregation
 * @property-read \App\PreparedTalk $preparedTalk
 * @property-read \App\User         $createdBy
 * @property-read \App\User         $updatedBy
 * @method static \Illuminate\Database\Query\Builder|\App\ScheduledTalk inCongregation($congregation)
 * @property integer                $circuit_id
 * @property-read \App\Circuit $circuit
 */
class ScheduledTalk extends Model
{
    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'scheduled_at'];

    // Scopes.

    public function scopeInCongregation(Builder $query, Congregation $congregation)
    {
        $query->where('congregation_id', $congregation->id);
    }

    // Relationships.

    /**
     * The circuit where the scheduled talk belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function circuit()
    {
        return $this->belongsTo('App\Circuit');
    }

    public function congregation()
    {
        return $this->belongsTo('App\Congregation');
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
