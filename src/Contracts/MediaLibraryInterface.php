<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaInterface;

interface MediaLibraryInterface
{
    public function add(UploadedFile $file);
}
