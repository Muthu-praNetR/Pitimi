<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TalkTitle
 * @property integer          $id
 * @property string           $title
 * @property integer          $talk_id
 * @property integer          $locale_id
 * @property \Carbon\Carbon   $created_at
 * @property \Carbon\Carbon   $updated_at
 * @property integer          $created_by
 * @property integer          $updated_by
 * @property-read \App\Talk   $talk
 * @property-read \App\Locale $locale
 * @property-read \App\User   $createdBy
 * @property-read \App\User   $updatedBy
 */
class TalkTitle extends Model
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
