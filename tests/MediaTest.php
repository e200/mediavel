<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Media;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\Media as MediaModel;

class MediaTest extends TestCase
{
    public function testBackup()
    {
        $media = new Media(Mockery::mock(MediaModel::class));

        $this->assertEquals($media, $media->backup());
    }

    public function testOptimize()
    {
        $media = new Media(Mockery::mock(MediaModel::class));

        $this->assertEquals($media, $media->optimize());
    }

    public function testResize()
    {
        $media = new Media(Mockery::mock(MediaModel::class));

        $this->assertEquals($media, $media->resize(0, 0));
    }

    public function testToCollection()
    {
        $media = new Media(Mockery::mock(MediaModel::class));

        $this->assertEquals($media, $media->toCollection('name'));
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
