<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaLibraryInterface
{
    public function add(UploadedFile $file);
}
