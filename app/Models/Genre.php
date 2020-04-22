<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Genre
 *
 * @property mixed name
 *
 */
class Genre extends Model
{
    protected $fillable = ['name'];

    /**
     * @return HasOne
     */
    public function book()
    {
        return $this->hasOne(Book::class);
    }
}
