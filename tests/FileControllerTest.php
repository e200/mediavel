<?php

namespace e200\Mediavel\Tests;

use Mockery;
use Illuminate\Http\Request;
use e200\Mediavel\FileHandler;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Http\Controllers\FileController;

class FileControllerTest extends TestCase
{
    public function testResolve()
    {
        $fileRequest     = Mockery::mock(Request::class);
        $fileHandlerMock = Mockery::mock(FileHandler::class);

        $fileHandlerMock
            ->allows()
            ->handle($fileRequest)
            ->andReturns(true);

        $fileController = new FileController($fileHandlerMock);

        $response = $fileController->resolve($fileRequest);

        $this->assertTrue($response);
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
