<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Media;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Contracts\Factories\MediaModelFactoryInterface;

class MediaTest extends TestCase
{
    public function testStore()
    {
        $mediaModelFactoryMock = Mockery::mock(MediaModelFactoryInterface::class);

        $mediaModelFactoryMock
            ->shouldReceive('makeFrom')
            ->with(Mockery::any());

        $media = $this->getInstance($mediaModelFactoryMock);

        $uploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $this->assertEquals($media, $media->store($uploadedFile));
    }

    public function testBackup()
    {
        $media = $this->getInstance();

        $this->assertEquals($media, $media->backup());
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

    protected function getInstance($mediaModelFactoryMock = null)
    {
        if (is_null($mediaModelFactoryMock)) {
            $mediaModelFactoryMock = Mockery::mock(MediaModelFactoryInterface::class);
        }

        return new Media($mediaModelFactoryMock);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
