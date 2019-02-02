<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaInterface
{
    public function store(UploadedFile $file, $diskName = null);

    public function preserveOriginal();

    public function optimize();

    public function resize($width, $heigth = null);

    public function toCollection($name);
}
