<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalkSubject extends Model
{
    // Relationships.

    public function talks()
    {
        return $this->belongsTo('App\Talk');
    }
}
