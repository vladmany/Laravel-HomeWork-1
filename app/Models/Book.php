<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed title
 * @property mixed annotation
 * @property mixed author
 * @property mixed genre_name
 * @property mixed year
 * @property mixed publisher_id
 * @property mixed preview_path
 * @property mixed body_path
 */
class Book extends Model
{
    protected $fillable = ['title', 'annotation', 'author', 'genre_name', 'year', 'publisher_id', 'preview_path', 'body_path'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
