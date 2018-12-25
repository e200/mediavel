<?php

namespace e200\Mediavel;

use Illuminate\Http\UploadedFile;
use e200\Mediavel\Contracts\StorageInterface;

class DiskStorage implements StorageInterface
{
    public function store(UploadedFile $uploadedFile)
    {
        $storagePath = $this->makeStorageRelativePath();

        return $uploadedFile->store($storagePath);
    }

    public function makeStorageRelativePath()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        return implode(
            DIRECTORY_SEPARATOR,
            [
                $currentYear,
                $currentMonth,
                time(),
            ]
        );
    }
}
