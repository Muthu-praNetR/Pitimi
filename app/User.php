<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * App\User
 * @property integer                                                           $id
 * @property string                                                            $first_name
 * @property string                                                            $last_name
 * @property string                                                            $email
 * @property string                                                            $password
 * @property boolean                                                           $is_admin
 * @property string                                                            $remember_token
 * @property string                                                            $deleted_at
 * @property \Carbon\Carbon                                                    $created_at
 * @property \Carbon\Carbon                                                    $updated_at
 * @property integer                                                           $created_by
 * @property integer                                                           $updated_by
 * @property integer                                                           $locale_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Congregation[] $congregations
 * @property-read \App\Locale                                                  $locale
 * @property-read \App\User                                                    $createdBy
 * @property-read \App\User                                                    $updatedBy
 */
class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes, InCircuit, InCongregation;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // Relationships.

    public function congregations()
    {
        return $this->belongsToMany('App\Congregation');
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
