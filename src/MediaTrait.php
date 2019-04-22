<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use e200\Mediavel\Contracts\StorageInterface;

trait MediaTrait
{
    protected $storage;

    public function __construct(
        StorageInterface $storage
    ) {
        $this->storage = $storage;
    }

    public function store($file, $disk = null)
    {
        if ($file instanceof UploadedFile) {
            $fileName = $file->getClientOriginalName();
            $fileMimeType = $file->getMimeType();
        }

        $storedFilePath = $this->saveOnStorage($file);

        $this->saveOnDatabase([
            'file_name' => $fileName,
            'file_path' => $storedFilePath,
            'mime_type' => $fileMimeType,
        ]);

        return $this;
    }

    public function crop($size)
    {
        $cropSize = config('mediavel.crop.sizes')[$size];

        $parentFilePath = $this->getFilePath();

        $width = $cropSize[0];
        $height = $cropSize[1];

        $image = Image::make($parentFilePath);

        $imageHeight = $image->height();
        $imageWidth = $image->width();

        if ($imageHeight < $height) {
            $height = $imageHeight;
        }

        if ($imageWidth < $width) {
            $width = $imageWidth;
        }

        $newImageFileName = $this->getFileNameFromParent($width, $height);

        $image
            ->crop($width, $height)
            ->save($newImageFileName);

        $this->saveOnDatabase([
            'file_name' => $newImageFileName,
            'mime_type' => $image->mime(),
            'parent_id' => $this->id,
        ], true);

        return $this;
    }

    public function saveOnStorage($filePath, $disk = null)
    {
        return $this->storage->store($filePath, $disk);
    }

    public function saveOnDatabase($data, $isChild = false)
    {
        if ($isChild) {
            $media = new Self();
        } else {
            $media = $this;
        }

        foreach ($data as $key => $value) {
            $media->{$key} = $value;
        }

        $media->save();

        return $media;
    }

    public function getFileNameFromParent($width = null, $height = null)
    {
        $fileInfo = pathinfo($this->file_path);

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

    public function getFilePath()
    {
        return $this->file_path;
    }

    public function getFullFilePath()
    {
        return storage_path().DIRECTORY_SEPARATOR.$this->getFilePath();
    }
}
