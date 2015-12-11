<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalkSubject extends Model
{
    // Relationships.

    public function talk()
    {
        return $this->belongsTo('App\Talk');
    }

    public function locale()
    {
        return $this->belongsTo('App\Locale');
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
