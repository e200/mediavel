<?php

namespace e200\Mediavel\Http\Controllers;

use Illuminate\Http\Request;
use e200\Mediavel\FileHandler;
use Illuminate\Routing\Controller;

class FileController extends Controller
{
    protected $fileHandler;

    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
    }

    public function resolve(Request $request)
    {
        return $this->fileHandler->handle($request);
    }
}
