<?php

namespace e200\Mediavel\Tests;

use Mockery;
use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Http\Controllers\ImageController;
use e200\Mediavel\ImageHandler;

class ImageControllerTest extends TestCase
{
    public function testResolve()
    {
        $imageRequest     = Mockery::mock(Request::class);
        $imageHandlerMock = Mockery::mock(ImageHandler::class);

        $imageHandlerMock
            ->allows()
            ->handle($imageRequest)
            ->andReturns(true);

        $imageController = new ImageController($imageHandlerMock);

        $response = $imageController->resolve($imageRequest);

        $this->assertTrue($response);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
