<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaLibraryInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaLibrary implements MediaLibraryInterface
{
    protected $MediaFactory;

    public function __construct(MediaFactoryInterface $MediaFactory)
    {
        $this->MediaFactory = $MediaFactory;
    }

    public function add(UploadedFile $file)
    {
        return $this->MediaFactory->make($file);
    }
}
