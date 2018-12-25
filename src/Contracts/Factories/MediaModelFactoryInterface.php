<?php

namespace e200\Mediavel\Contracts\Factories;

use Illuminate\Http\UploadedFile;

interface MediaModelFactoryInterface
{
    public function makeFrom(UploadedFile $uploadedFile);
}
