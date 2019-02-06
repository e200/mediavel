<?php

namespace e200\Mediavel;

use Laravel\Lumen\Http\Request;
use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;
use e200\Mediavel\Contracts\Factories\MimeTypeFactoryInterface;

trait MediaTrait
{
    protected $mediaFactory;
    protected $mimeTypeFactory;
    protected $storage;

    public function __construct(
        MediaFactoryInterface $mediaFactory,
        MimeTypeFactoryInterface $mimeTypeFactory,
        StorageInterface $storage
    ) {
        $this->mediaFactory = $mediaFactory;
        $this->mimeTypeFactory = $mimeTypeFactory;
        $this->storage = $storage;
    }

    public function store(UploadedFile $uploadedFile, $diskName = null)
    {
        $storedFilePath = $this->storage->store($uploadedFile, $diskName);

        $fileName = $uploadedFile->hashName();
        $fileClientName = $uploadedFile->getClientOriginalName();
        $fileMimeType = $uploadedFile->getMimeType();

        $mimeType = $this->mimeTypeFactory->make($fileMimeType);

        $this->client_name = $fileClientName;
        $this->file_path = $storedFilePath;
        $this->mime_type_id = $mimeType->id;

        $this->save();

        return $this;
    }

    public function preserveOriginal()
    {
        $this->getDirPath();

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
