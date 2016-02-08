<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contact
 *
 * @property integer $id
 * @property string $name
 * @property string $number
 * @property integer $group_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Contact extends Model
{
    //

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
