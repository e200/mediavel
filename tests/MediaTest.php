<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\Models\Media;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;
use e200\Mediavel\Contracts\Factories\MimeTypeFactoryInterface;

class MediaTest extends TestCase
{
    public function testGetThumbnailFilename()
    {
        $media = $this->getInstance();

        $parentFileName = 'medias/2019/02/1549447594/icECvudN64gd3pOKz7G1f0afACLhDCHmZ8X4hhWu.jpeg';

        $this->assertEquals($media->getThumbnailFilename($parentFileName, 100, 100), 'medias/2019/02/1549447594/icECvudN64gd3pOKz7G1f0afACLhDCHmZ8X4hhWu-100x100.jpeg');
    }

    protected function getInstance()
    {
        $mediaFactoryMock = Mockery::mock(MediaFactoryInterface::class);
        $mimeTypeFactoryMock = Mockery::mock(MimeTypeFactoryInterface::class);
        $storageMock = Mockery::mock(StorageInterface::class);

        return new Media($mediaFactoryMock, $mimeTypeFactoryMock, $storageMock);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
