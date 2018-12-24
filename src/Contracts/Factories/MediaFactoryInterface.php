<?php

namespace e200\Mediavel\Contracts\Factories;

use Illuminate\Http\UploadedFile;

interface MediaFactoryInterface
{
    public function make(UploadedFile $file);
}
