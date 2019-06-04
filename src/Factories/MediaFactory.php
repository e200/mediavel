<?php

namespace e200\Mediavel\Factories;

use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Contracts\MediaFactoryInterface;

class MediaFactory implements MediaFactoryInterface
{
    public function make()
    {
        return app(MediaInterface::class);
    }
}
