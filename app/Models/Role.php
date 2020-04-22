<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string name
 */
class Role extends Model
{
    /**
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
