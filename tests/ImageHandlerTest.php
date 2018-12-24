<?php

namespace e200\Mediavel\Tests;

use Mockery;
use Illuminate\Http\Request;
use e200\Mediavel\ImageHandler;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;

class ImageHandlerTest extends TestCase
{
    public function testHandler()
    {
        $imageHandler = new ImageHandler();

        $uploadedFile = UploadedFile::fake()->image('validImage.jpg');

        $request = Request::create('/mediavel/image', 'POST', ['image' => $uploadedFile]);

        $response = $imageHandler->handle($request);

        $this->assertTrue($response);
    }

    public function testHandlerWithInvalidImage()
    {
        $imageHandler = new ImageHandler();

        $badImageContent = ':/';

        $request = Request::create('/mediavel/image', 'POST', ['image' => $badImageContent]);

        $response = $imageHandler->handle($request);

        $content = $response->getContent();

        $this->assertJson($content);

        $jsonArray = (array)json_decode($content);

        $this->assertArrayHasKey('reason', $jsonArray);
        $this->assertArrayHasKey('statusCode', $jsonArray);
    }
}
