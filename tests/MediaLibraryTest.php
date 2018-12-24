<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\MediaLibrary;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaLibraryTest extends TestCase
{
    public function testAdd()
    {
        $MediaFactoryMock = Mockery::mock(MediaFactoryInterface::class);

        $uploadedFileMock = Mockery::mock(UploadedFile::class);

        $MediaFactoryMock
            ->allows()
            ->make($uploadedFileMock)
            ->andReturns(true);

        $mediaLibrary = new MediaLibrary($MediaFactoryMock);

        $this->assertTrue($mediaLibrary->add($uploadedFileMock));
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
