<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The ScheduledTalk class.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
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
