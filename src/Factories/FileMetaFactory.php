<?php

namespace e200\Mediavel\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\FileMeta;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\Factories\FileMetaFactoryInterface;

class FileMetaFactory implements FileMetaFactoryInterface
{
    protected $fileMeta;
    protected $mimeType;

    public function __construct(FileMeta $fileMeta, MimeType $mimeType)
    {
        $this->fileMeta = $fileMeta;
        $this->mimeType = $mimeType;
    }

    public function makeFrom(UploadedFile $uploadedFile, $filePath)
    {
        $fileName = $uploadedFile->hashName();
        $fileClientName = $uploadedFile->getClientOriginalName();
        $fileMimeType = $uploadedFile->getMimeType();

        $mimeType = $this->mimeType->firstOrCreate(['value' => $fileMimeType]);

        $fileMeta = $this->fileMeta->create([
            'client_name'  => $fileClientName,
            'file_path'    => $filePath,
            'mime_type_id' => $mimeType->id,
        ]);

        return $fileMeta;
    }
}
