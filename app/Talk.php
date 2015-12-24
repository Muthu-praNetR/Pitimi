<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The Talk class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer        $id
 * @property integer        $number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer        $created_by
 * @property integer        $updated_by
 * @property-read \App\User $createdBy
 * @property-read \App\User $updatedBy
 */
class Talk extends Model
{
    // Relationships.

    /**
     * Get all subjects.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\TalkSubject');
    }

    /**
     * Get the user that created the talk.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Get the user that last updated the talk.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
