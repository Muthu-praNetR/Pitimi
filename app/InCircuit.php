<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

/**
 * The InCircuit trait.
 * @package App
 * @author  Rubens Mariuzzo <rubens@mariuzzo.com>
 */
trait InCircuit
{
    // Scopes.

    public function inCircuit(Builder $query, $circuit_id)
    {
        $query->where('circuit_id', $circuit_id);
    }

    // Relationships.

    public function circuit()
    {
        return $this->belongsTo('App\Circuit');
    }
}