<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;

class DiskStorage implements StorageInterface
{
    public function store(UploadedFile $uploadedFile, $disk = null)
    {
        $storagePath = $this->makeStorageRelativePath();

        if (is_null($disk)) {
            $disk = config('mediavel.disk.default');
        }

        $storageName = config('mediavel.storage.name');

        return $uploadedFile->store($storageName.DIRECTORY_SEPARATOR.$storagePath, $disk);
    }

    public function makeStorageRelativePath()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageRelativePathParts = [
            $currentYear,
            $currentMonth,
            time(),
        ];

        return implode(DIRECTORY_SEPARATOR, $storageRelativePathParts);
    }
}
