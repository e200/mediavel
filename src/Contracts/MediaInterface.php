<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\MimeType;

interface MediaInterface
{
    public function store(UploadedFile $file);

    public function backup();

    public function optimize();

    public function resize($width, $heigth = null);

    public function toCollection($name);
}
