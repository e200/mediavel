<?php

namespace e200\Mediavel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use e200\Mediavel\Contracts\Factories\MediaFactoryInterface;

class ImageController extends Controller
{
    protected $mediaFactory;

    public function __construct(MediaFactoryInterface $mediaFactory)
    {
        $this->mediaFactory = $mediaFactory;
    }

    public function add(Request $request)
    {
        $validation = ['image' => 'bail|required|mimes:jpeg,jpg,png,gif,svg|max:5012'];

        try {
            $this->validate($request, $validation);

            $media = $this->mediaFactory->make();

            $storedImage = $media->store($request->image);

            $storedImage->generateThumbnails();

            return response()->json($storedImage);
        } catch (ValidationException $ex) {
            $errors = $ex->errors();

            $message = $errors['image'][0];

            return response()->json([
                'reason'     => $message,
                'statusCode' => $ex->status,
            ]);
        }
    }
}
