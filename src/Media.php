<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\FileMetaFactoryInterface;

class Media implements MediaInterface
{
    protected $fileMeta;
    protected $fileMetaFactory;
    protected $storage;

    public function __construct(
        FileMetaFactoryInterface $fileMetaFactory,
        StorageInterface $storage
    ) {
        $this->fileMetaFactory = $fileMetaFactory;
        $this->storage = $storage;
    }

    public function store(UploadedFile $uploadedFile)
    {
        $this->fileMeta = $this->fileMetaFactory->makeFrom($uploadedFile);

        $this->storage->store($uploadedFile, $this->fileMeta);

        return $this;
    }

    public function backupOriginal($path)
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

    public function get()
    {
        return $this->file;
    }
}
