<?php

namespace e200\Mediavel\Tests\Factories;

use Mockery;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\MediavelServiceProvider;
use e200\Mediavel\Factories\MediaFactory;
use e200\Mediavel\Contracts\MediaInterface;

class MediaFactoryTest extends TestCase
{
    /**
     * Test if controller calls
     * the method `resolve`
     *
     * @return void
     */
    public function testMake()
    {
        $MediaFactory = new MediaFactory();

        $this->assertInstanceOf(
            MediaInterface::class,
            $MediaFactory->make(Mockery::mock(UploadedFile::class))
        );
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
