<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * The InCongregation trait.
 * @package App
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
trait InCongregation
{
    // Scopes.

    public function inCongregation(Builder $query, $congregation_id)
    {
        $query->where('congregation_id', $congregation_id);
    }

    // Relationships.

    public function congregation()
    {
        return $this->belongsTo('App\Congregation');
    }
}