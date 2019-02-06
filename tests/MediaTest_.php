<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Models\Media;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class MediaTest extends TestCase
{
    public function testStore()
    {
        $mediaFactoryMock = Mockery::mock(MediaFactoryInterface::class);
        $storageMock = Mockery::mock(StorageInterface::class);

        $mediaFactoryMock
            ->shouldReceive('makeFrom')
            ->withAnyArgs()
            ->andReturns(Mockery::mock(Media::class));

        $storageMock
            ->shouldReceive('store')
            ->withAnyArgs();

        $media = $this->getInstance($mediaFactoryMock, $storageMock);

        $uploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $this->assertEquals($media, $media->store($uploadedFile));
    }

    public function testBackupOriginal()
    {
        static::markTestSkipped('must be revisited.');

        $media = $this->getInstance();

        // $this->assertEquals($media, $media->backupOriginal());
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

    protected function getInstance($mediaFactoryMock = null, $storage = null)
    {
        if (is_null($mediaFactoryMock)) {
            $mediaFactoryMock = Mockery::mock(MediaFactoryInterface::class);
        }

        if (is_null($storage)) {
            $storage = Mockery::mock(StorageInterface::class);
        }

        return new Media($mediaFactoryMock, $storage);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
