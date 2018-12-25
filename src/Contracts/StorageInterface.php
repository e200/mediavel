<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\FileMeta;

interface StorageInterface
{
    public function store(UploadedFile $uploadedFile);
}
