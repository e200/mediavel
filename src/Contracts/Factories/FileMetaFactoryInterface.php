<?php

namespace e200\Mediavel\Contracts\Factories;

use Illuminate\Http\UploadedFile;

interface FileMetaFactoryInterface
{
    public function makeFrom(UploadedFile $uploadedFile, $filePath);
}
