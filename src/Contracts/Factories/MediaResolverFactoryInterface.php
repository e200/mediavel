<?php

namespace e200\Mediavel\Contracts\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaResolverInterface;

interface MediaResolverFactoryInterface
{
    public function make(UploadedFile $file) : MediaResolverInterface;
}
