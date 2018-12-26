<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaLibraryInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaLibrary implements MediaLibraryInterface
{
    protected $mediaFactory;

    public function __construct(MediaFactoryInterface $mediaFactory)
    {
        $this->mediaFactory = $mediaFactory;
    }

    public function add(UploadedFile $file)
    {
        $media = $this->mediaFactory->make();

        $media->store($file);

        return $media;
    }

    public function get($id)
    {
        //
    }

    public function del($id)
    {
        //
    }

    public function createCollection($name)
    {
        //
    }

    public function getCollection($name)
    {
        //
    }

    public function delCollection($name)
    {
        //
    }
}
