<?php

namespace e200\Mediavel\Factories;

use e200\Mediavel\MediaResolver;
use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaResolverInterface;
use e200\Mediavel\Contracts\Factories\MediaResolverFactoryInterface;

class MediaResolverFactory implements MediaResolverFactoryInterface
{
    public function make(UploadedFile $file) : MediaResolverInterface
    {
        return app(MediaResolver::class);
    }
}
