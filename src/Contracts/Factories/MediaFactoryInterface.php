<?php

namespace e200\Mediavel\Contracts\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaInterface;

interface MediaFactoryInterface
{
    public function make(UploadedFile $file);
}
