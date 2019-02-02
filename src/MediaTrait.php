<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

trait MediaTrait
{
    protected $media;
    protected $mediaFactory;
    protected $storage;

    public function __construct(
        MediaFactoryInterface $mediaFactory,
        StorageInterface $storage
    ) {
        $this->mediaFactory = $mediaFactory;
        $this->storage = $storage;
    }

    public function store(UploadedFile $uploadedFile, $diskName = null)
    {
        $filePath = $this->storage->store($uploadedFile, $diskName);

        $media = $this->mediaFactory->makeFrom($uploadedFile, $filePath);

        return $this;
    }

    public function preserveOriginal()
    {
        $media = $this->media;

        if (is_null($media)) {
            // throwException
        }

        $media->getDirPath();

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

    public function get()
    {
        return $this->file;
    }
}
