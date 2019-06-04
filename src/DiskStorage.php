<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use e200\Mediavel\Contracts\StorageInterface;

class DiskStorage implements StorageInterface
{
    public function store(UploadedFile $uploadedFile, $disk = null) : Media
    {
        if (is_null($disk)) {
            $disk = config('mediavel.disks.default');
        }

        $fileName = $uploadedFile->getClientOriginalName();
        $filePath = $uploadedFile->getPath();
        $fileExt = $uploadedFile->getClientOriginalExtension();
        $fileMimeType = $uploadedFile->getMimeType();

        $randomFileName = $this->generateFilename($fileExt);

        $storagePath = $this->getStoragePath();

        $uploadFilePath = $storagePath.DIRECTORY_SEPARATOR.$randomFileName;

        Storage::disk($disk)->put($uploadFilePath, File::get($uploadedFile));

        $userId = null;
        $user = Auth::guard('api')->user();

        if ($user) {
            $userId = $user->id;
        }

        $media = Media::create([
            'name'      => $fileName,
            'path'      => $uploadFilePath,
            'mime_type' => $fileMimeType,
            'user_id'   => $userId,
        ]);

        return $media;
    }

    public function getStoragePath()
    {
        $folderName = config('mediavel.folder_name');

        $pathGeneratorClass = config('mediavel.path_generator');

        $storagePath = app($pathGeneratorClass)->generate($folderName);

        return $storagePath;
    }

    public function generateFilename($ext)
    {
        return uniqid().'.'.$ext;
    }
}
