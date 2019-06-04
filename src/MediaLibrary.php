<?php

namespace e200\Mediavel;

use e200\Mediavel\Contracts\MediaLibraryInterface;
use e200\Mediavel\Contracts\MediaResolverInterface;

class MediaLibrary implements MediaLibraryInterface
{
    protected $mediaResolver;

    public function __construct(MediaResolverInterface $mediaResolver)
    {
        $this->mediaResolver = $mediaResolver;
    }

    public function add($request)
    {
        return $this->mediaResolver->resolve($request);
    }

    public function get($id)
    {
        $media = $this->mediaFactory->make();

        return $media->find($id);
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
