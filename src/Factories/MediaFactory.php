<?php

namespace e200\Mediavel\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaFactory implements MediaFactoryInterface
{
    public function make(UploadedFile $file)
    {
        return app(MediaInterface::class);
    }
}
