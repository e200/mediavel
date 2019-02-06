<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
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

    public function store($file, $disk = null)
    {
        $storedFilePath = $this->storage->store($file, $disk);

        if (is_string($file)) {
            $fileName = pathinfo($file, PATHINFO_BASENAME);
            $fileClientName = pathinfo($file, PATHINFO_BASENAME);
            $fileName = pathinfo($file, PATHINFO_BASENAME);
        }

        if ($file instanceof UploadedFile) {
            $fileName = $file->hashName();
            $fileClientName = $file->getClientOriginalName();
            $fileMimeType = $file->getMimeType();
        }

        $mimeType = $this->mimeTypeFactory->make($fileMimeType);

        $this->client_name = $fileClientName;
        $this->file_path = $storedFilePath;
        $this->mime_type_id = $mimeType->id;

        $this->save();

        return $this;
    }

    public function generateThumbnails()
    {
        $thumbnailSizes = config('mediavel.thumbnails');

        foreach ($thumbnailSizes as $thumbnailSize) {
            $this->generateThumbnail($thumbnailSize);
        }
    }

    public function generateThumbnail($thumbnailSize)
    {
        $width = null;
        $height = null;

        $parentImagePath = $this->file_path;

        $image = Image::make(storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$parentImagePath);

        $imageHeight = $image->height();
        $imageWidth = $image->width();

        if (is_array($thumbnailSize)) {
            $width = $thumbnailSize[0];
            $height = $thumbnailSize[1];
        } else {
            $width = $thumbnailSize;
            $height = $thumbnailSize;
        }

        if ($imageHeight < $height) {
            $height = $imageHeight;
        }

        if ($imageWidth < $width) {
            $width = $imageWidth;
        }

        $image->crop($width, $height);

        $thumbnailFileName = $this->getThumbnailFileName($parentImagePath, $width, $height);

        $image->save($thumbnailFileName);

        $thumbnailMedia = $this->mediaFactory->make();

        $thumbnailMedia->file_path = $thumbnailFileName;
        $thumbnailMedia->mime_type_id = $this->mime_type_id;

        $thumbnailMedia->save();
    }

    public function getThumbnailFileName($parentFileName, $width, $height)
    {
        $fileInfo = pathinfo($parentFileName);

        return $fileInfo['dirname'].
                DIRECTORY_SEPARATOR.
                $fileInfo['filename'].
                '-'.
                $width.
                'x'.
                $height.
                '.'.
                $fileInfo['extension'];
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
