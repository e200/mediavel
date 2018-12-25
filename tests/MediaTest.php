<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Media;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\FileMeta;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\FileMetaFactoryInterface;

class MediaTest extends TestCase
{
    public function testStore()
    {
        $fileMetaFactoryMock = Mockery::mock(FileMetaFactoryInterface::class);
        $storageMock = Mockery::mock(StorageInterface::class);

        $fileMetaFactoryMock
            ->shouldReceive('makeFrom')
            ->with(Mockery::any(), Mockery::any())
            ->andReturns(Mockery::mock(FileMeta::class));

        $storageMock
            ->shouldReceive('store')
            ->with(Mockery::any());

        $media = $this->getInstance($fileMetaFactoryMock, $storageMock);

        $uploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $this->assertEquals($media, $media->store($uploadedFile));
    }

    public function testBackupOriginal()
    {
        $media = $this->getInstance();

        $this->assertEquals($media, $media->backupOriginal(null));
    }

    public function testOptimize()
    {
        $media = $this->getInstance();

        $this->assertEquals($media, $media->optimize());
    }

    public function testResize()
    {
        $media = $this->getInstance();

        $this->assertEquals($media, $media->resize(0, 0));
    }

    public function testToCollection()
    {
        $media = $this->getInstance();

        $this->assertEquals($media, $media->toCollection('name'));
    }

    protected function getInstance($fileMetaFactoryMock = null, $storage = null)
    {
        if (is_null($fileMetaFactoryMock)) {
            $fileMetaFactoryMock = Mockery::mock(FileMetaFactoryInterface::class);
        }

        if (is_null($storage)) {
            $storage = Mockery::mock(StorageInterface::class);
        }

        return new Media($fileMetaFactoryMock, $storage);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
