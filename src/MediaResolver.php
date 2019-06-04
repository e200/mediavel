<?php

namespace e200\Mediavel;

use Illuminate\Http\Request;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\MediaInfoInterface;
use e200\Mediavel\Contracts\MediaFactoryInterface;
use e200\Mediavel\Contracts\MediaResolverInterface;
use e200\Mediavel\Contracts\MediaValidatorInterface;

class MediaResolver implements MediaResolverInterface
{
    protected $storage;
    protected $mediaValidator;

    public function __construct(
        MediaValidatorInterface $mediaValidator,
        StorageInterface        $storage
    ) {
        $this->storage        = $storage;
        $this->mediaValidator = $mediaValidator;
    }

    public function resolve(Request $request, $field = 'media')
    {
        $uploadedMedia = $request->{$field};

        $this->mediaValidator->validate($request, $field);

        $media = $this->storage->store($uploadedMedia);

        return $media;
    }
}
