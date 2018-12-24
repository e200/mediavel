<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Media;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Models\Media as MediaModel;

class MediaTest extends TestCase
{
    public function testStore()
    {
        $mimeType = Mockery::mock(MimeType::class)
            ->shouldIgnoreMissing();

        $mimeType
            ->shouldReceive('firstOrCreate')
            ->with(Mockery::any())
            ->andReturns($mimeType);

        $mimeType->id = 1;

        $mediaModel = Mockery::mock(MediaModel::class);

        $mediaModel
            ->shouldReceive('create')
            ->with(Mockery::any())
            ->andReturns($mediaModel);

        $media = $this->getInstance($mediaModel);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->assertEquals($media, $media->store($file, $mimeType));
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

    protected function getInstance($mediaMock = null)
    {
        if (is_null($mediaMock)) {
            $mediaMock = Mockery::mock(MediaModel::class);
        }

        return new Media($mediaMock);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
