<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * The Talk class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 * @property integer                                                           $id
 * @property integer                                                           $number
 * @property \Carbon\Carbon                                                    $created_at
 * @property \Carbon\Carbon                                                    $updated_at
 * @property integer                                                           $created_by
 * @property integer                                                           $updated_by
 * @property-read \App\User                                                    $createdBy
 * @property-read \App\User                                                    $updatedBy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TalkTitle[]    $titles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PreparedTalk[] $prepared
 */
class Talk extends Model
{
    // Scopes.

    public function scopeTranslateTo(Builder $query, Locale $locale)
    {
        $query->with(['titles' => function ($query) use ($locale) {
            $query->where('locale_id', $locale->id);
        }]);
    }

    // Relationships.

    /**
     * Get all titles.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function titles()
    {
        return $this->hasMany('App\TalkTitle');
    }

    /**
     * Get all prepared talks.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prepared()
    {
        return $this->hasMany('App\PreparedTalk');
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

    // Accessor.

    public function getTitleAttribute()
    {
        return $this->titles->first()->title;
    }
}
