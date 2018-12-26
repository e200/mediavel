<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;

interface StorageInterface
{
    public function store(UploadedFile $uploadedFil, $diskName);
}
