<?php

namespace e200\Mediavel\Tests\Factories;

use Mockery;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\Media;
use e200\Mediavel\Models\MimeType;
use e200\Mediavel\MediavelServiceProvider;
use e200\Mediavel\Factories\MediaFactory;

class MediaFactoryTest extends TestCase
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

        $MediaMock = Mockery::mock(Media::class);

        $MediaMock->shouldReceive('getAttribute');

        $MediaMock
            ->shouldReceive('create')
            ->withAnyArgs()
            ->andReturns($MediaMock);

        $MediaFactory = new MediaFactory(
            $MediaMock,
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

        $Media = $MediaFactory->makeFrom($uploadedFileMock, '/storage/image.jpg');

        $this->assertInstanceOf(Media::class, $Media);
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
