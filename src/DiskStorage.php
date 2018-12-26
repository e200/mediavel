<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;

class DiskStorage implements StorageInterface
{
    public function store(UploadedFile $uploadedFile, $diskName = null)
    {
        $storagePath = $this->makeStorageRelativePath();

        if (is_null($diskName)) {
            $diskName = config('mediavel.disk');
        }

        return $uploadedFile->store('media'.DIRECTORY_SEPARATOR.$storagePath, $diskName);
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
