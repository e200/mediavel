<?php

namespace e200\Mediavel\Factories;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\Factories\MediaModelFactoryInterface;

class MediaModelFactory implements MediaModelFactoryInterface
{
    public function makeFrom(UploadedFile $uploadedFile)
    {
        $fileName = $file->hashName();
        $fileClientName = $file->getClientOriginalName();
        $fileMimeType = $file->getMimeType();

        $mimeType = $mimeType->firstOrCreate(['value' => $fileMimeType]);

        return $this->mediaModel->create([
            'client_name'  => $fileClientName,
            'file_name'    => $fileName,
            'mime_type_id' => $mimeType->id,
        ]);
    }
}
