<?php

namespace e200\Mediavel;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;
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
        $this->storage = $storage;
        $this->mediaValidator = $mediaValidator;
    }

    public function resolve($request, $field = 'media')
    {
        if ($request instanceof UploadedFile) {
            $uploadedMedia = $request;
        } else {
            $uploadedMedia = $request->{$field};

            $this->mediaValidator->validate($request, $field);
        }

        $media = $this->storage->store($uploadedMedia);

        return $media;
    }
}
