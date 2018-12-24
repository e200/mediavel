<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\MediaLibrary;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\MediaInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaLibraryTest extends TestCase
{
    public function testAdd()
    {
        $mediaMock        = Mockery::mock(MediaInterface::class);
        $mediaFactoryMock = Mockery::mock(MediaFactoryInterface::class);
        $uploadedFileMock = Mockery::mock(UploadedFile::class);

        $mediaMock
            ->shouldReceive('store')
            ->with(
                Mockery::any(),
                Mockery::any()
            );

        $mediaFactoryMock
            ->shouldReceive('make')
            ->andReturns($mediaMock);

        $mediaLibrary = new MediaLibrary($mediaFactoryMock);

        $this->assertInstanceOf(MediaInterface::class, $mediaMock);
        $this->assertSame($mediaMock, $mediaLibrary->add($uploadedFileMock));
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
