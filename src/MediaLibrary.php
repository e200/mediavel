<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaLibraryInterface;
use e200\Mediavel\Contracts\MediaResolverInterface;
use e200\Mediavel\Contracts\Factories\MediaResolverFactoryInterface;

class MediaLibrary implements MediaLibraryInterface
{
    protected $mediaResolverFactory;

    public function __construct(MediaResolverFactoryInterface $mediaResolverFactory)
    {
        $this->mediaResolverFactory = $mediaResolverFactory;
    }

    public function add(UploadedFile $file) : MediaResolverInterface
    {
        return $this->mediaResolverFactory->make($file);
    }
}
