<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;

class DiskStorage implements StorageInterface
{
    public function store(UploadedFile $uploadedFile)
    {
        $storagePath = config('mediavel.storage.path');

        $storageDirPath = $this->resolveStorageDir($storagePath);

        return $uploadedFile->store($storageDirPath);
    }

    public function resolveStorageDir($storagePath)
    {
        $storageDirPath = $this->getStorageDirPath($storagePath);

        if (! is_dir($storageDirPath)) {
            if (! mkdir($storageDirPath, 755, true)) {
                return false;
            }
        }

        return $storageDirPath;
    }

    public function getStorageDirPath($storagePath)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        return implode(
            DIRECTORY_SEPARATOR,
            [
                $storagePath,
                $currentYear,
                $currentMonth,
                time(),
            ]
        );
    }
}
