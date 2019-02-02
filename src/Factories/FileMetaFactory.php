<?php

namespace e200\Mediavel\Factories;

use e200\Mediavel\Models\Media;
use Illuminate\Http\UploadedFile;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class FileMetaFactory implements MediaFactoryInterface
{
    protected $Media;
    protected $mimeType;

    public function __construct(Media $Media, MimeType $mimeType)
    {
        $this->Media = $Media;
        $this->mimeType = $mimeType;
    }

    public function makeFrom(UploadedFile $uploadedFile, $filePath)
    {
        $fileName = $uploadedFile->hashName();
        $fileClientName = $uploadedFile->getClientOriginalName();
        $fileMimeType = $uploadedFile->getMimeType();

        $mimeType = $this->mimeType->firstOrCreate(['value' => $fileMimeType]);

        $Media = $this->Media->create([
            'client_name'  => $fileClientName,
            'file_path'    => $filePath,
            'mime_type_id' => $mimeType->id,
        ]);

        return $Media;
    }
}
