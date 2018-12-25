<?php

namespace e200\Mediavel\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\FileMeta;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\Factories\FileMetaFactoryInterface;

class FileMetaFactory implements FileMetaFactoryInterface
{
    protected $mimeType;
    protected $fileMeta;

    public function __construct(FileMeta $fileMeta, MimeType $mimeType)
    {
        $this->fileMeta = $fileMeta;
        $this->mimeType = $mimeType;
    }

    public function makeFrom(UploadedFile $uploadedFile)
    {
        $fileName = $fileMeta->hashName();
        $fileClientName = $fileMeta->getClientOriginalName();
        $fileMimeType = $fileMeta->getMimeType();

        $mimeType = $this->mimeType->firstOrCreate(['value' => $fileMimeType]);

        $fileMeta = $this->fileMeta->create([
            'client_name'  => $fileClientName,
            'file_name'    => $fileName,
            'mime_type_id' => $mimeType->id,
        ]);

        return $fileMeta;
    }
}
