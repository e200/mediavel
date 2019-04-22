<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use e200\Mediavel\Contracts\StorageInterface;

class LocalStorage implements StorageInterface
{
    public function store($file, $disk = null)
    {
        $storagePath = $this->getStoragePath();

        if (is_string($file)) {
            $filePath = $file;
            $fileExt = pathinfo($file, PATHINFO_EXTENSION);
        }

        if ($file instanceof UploadedFile) {
            $filePath = $file->getPath();
            $fileExt = $file->getClientOriginalExtension();
        }

        if (is_null($disk)) {
            $disk = config('mediavel.disks.default');
        }

        $fileName = $this->getFileName($fileExt);

        $storedFilePath = $storagePath.DIRECTORY_SEPARATOR.$fileName;

        Storage::disk($disk)->put($storedFilePath, File::get($file));

        return $storedFilePath;
    }

    public function getStoragePath()
    {
        $folderName = config('mediavel.folder_name');

        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageRelativePathParts = [
            $folderName,
            $currentYear,
            $currentMonth,
            time(),
        ];

        return implode(DIRECTORY_SEPARATOR, $storageRelativePathParts);
    }

    public function getFileName($ext)
    {
        return uniqid().'.'.$ext;
    }
}
