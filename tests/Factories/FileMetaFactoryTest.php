<?php

namespace e200\Mediavel\Tests\Factories;

use Mockery;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\FileMeta;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\MediavelServiceProvider;
use e200\Mediavel\Factories\FileMetaFactory;

class FileMetaFactoryTest extends TestCase
{
    /**
     * Test if controller calls
     * the method `resolve`.
     *
     * @return void
     */
    public function testMakeFrom()
    {
        $mimeTypeMock = Mockery::mock(MimeType::class);

        $mimeTypeMock
            ->shouldReceive('firstOrCreate')
            ->withAnyArgs()
            ->once()
            ->andReturnSelf();

        $mimeTypeMock
            ->shouldReceive('getAttribute')
            ->with('id')
            ->andReturns(1);

        $fileMetaMock = Mockery::mock(FileMeta::class);

        $fileMetaMock->shouldReceive('getAttribute');

        $fileMetaMock
            ->shouldReceive('create')
            ->withAnyArgs()
            ->andReturns($fileMetaMock);

        $fileMetaFactory = new FileMetaFactory(
            $fileMetaMock,
            $mimeTypeMock
        );

        $uploadedFileMock = Mockery::mock(UploadedFile::class);

        $uploadedFileMock
            ->shouldReceive('hashName')
            ->andReturns('hash_name');

        $uploadedFileMock
            ->shouldReceive('getClientOriginalName')
            ->andReturns('client_name');

        $uploadedFileMock
            ->shouldReceive('getMimeType')
            ->andReturns('image/jpg');

        $fileMeta = $fileMetaFactory->makeFrom($uploadedFileMock, '/storage/image.jpg');

        $this->assertInstanceOf(FileMeta::class, $fileMeta);
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    protected function getPackageProviders($app)
    {
        return MediavelServiceProvider::class;
    }
}
