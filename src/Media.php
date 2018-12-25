<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Models\Media as MediaModel;
use e200\Mediavel\Contracts\Factories\MediaModelFactoryInterface;

class Media implements MediaInterface
{
    protected $mediaModelFactory;

    public function __construct(MediaModelFactoryInterface $mediaModelFactory)
    {
        $this->mediaModelFactory = $mediaModelFactory;
    }

    public function store(UploadedFile $uploadedFile)
    {
        if ($uploadedFile->isValid()) {
            $storagePath = $storageFolder->getPath();

            $uploadedFile->store($storagePath . DIRECTORY_SEPARATOR . 'images');

            $media = $this->mediaModelFactory->makeFrom($uploadedFile);
        }

        return $this;
    }

    public function backup()
    {
        return $this;
    }

    public function optimize()
    {
        return $this;
    }

    public function resize($width, $heigth = null)
    {
        return $this;
    }

    public function toCollection($name)
    {
        return $this;
    }

    public function getThumbnails()
    {
        return [];
    }
}
