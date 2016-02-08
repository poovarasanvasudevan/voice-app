<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Group
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Group extends Model
{
    //

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
