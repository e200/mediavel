<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\Media;

trait HasPicture
{
    public function picture()
    {
        return $this->belongsTo(Media::class, 'picture_id');
    }
}
