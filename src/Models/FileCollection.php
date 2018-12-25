<?php

namespace e200\Mediavel\Models;

use Illuminate\Database\Eloquent\Model;

class FileCollection extends Model
{
    protected $fillable = ['name'];

    public function medias()
    {
        return $this->hasMany(File::class);
    }
}
