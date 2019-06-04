<?php

namespace e200\Mediavel\Models;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class MediaCollection extends Model
{
    protected $fillable = ['name'];

    public function files()
    {
        return $this->hasMany(Media::class);
    }
}
