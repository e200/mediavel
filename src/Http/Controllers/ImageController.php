<?php

namespace e200\Mediavel\Http\Controllers;

use Illuminate\Http\Request;
use e200\Mediavel\ImageHandler;
use Illuminate\Routing\Controller;

class ImageController extends Controller
{
    protected $imageHandler;

    public function __construct(ImageHandler $imageHandler)
    {
        $this->imageHandler = $imageHandler;
    }

    public function resolve(Request $request)
    {
        return $this->imageHandler->handle($request);
    }
}
