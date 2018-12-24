<?php

namespace e200\Mediavel\Factories;

use e200\Mediavel\Media;
use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaFactory implements MediaFactoryInterface
{
    public function make()
    {
        return app(MediaInterface::class);
    }
}
