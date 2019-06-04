<?php

namespace e200\Mediavel\Contracts;

use e200\Mediavel\Models\Media;
use Illuminate\Http\UploadedFile;

interface StorageInterface
{
    public function store(UploadedFile $uploadedFile, $diskName) : Media;
}
