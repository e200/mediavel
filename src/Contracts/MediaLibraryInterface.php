<?php

namespace e200\Mediavel\Contracts;

use Illuminate\Http\UploadedFile;

interface MediaLibraryInterface
{
    public function add(UploadedFile $file);
    public function get($id);
    public function del($id);
    public function createCollection($name);
    public function getCollection($name);
    public function delCollection($name);
}
