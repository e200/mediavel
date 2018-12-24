<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Models\Media as MediaModel;

class Media implements MediaInterface
{
    protected $mediaModel;

    public function __construct(MediaModel $mediaModel)
    {
        $this->mediaModel = $mediaModel;
    }

    public function store(UploadedFile $file, MimeType $mimeType)
    {
        $FileName       = $file->hashName();
        $fileClientName = $file->getClientOriginalName();
        $fileMimeType   = $file->getMimeType();

        $mimeType = $mimeType->firstOrCreate(['value' => $fileMimeType]);

        $this->mediaModel->create([
            'client_name'  => $fileClientName,
            'file_name'    => $FileName,
            'mime_type_id' => $mimeType->id,
        ]);

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
}
