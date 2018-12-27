<?php

namespace e200\Mediavel\Http\Controllers;

use Illuminate\Http\Request;
use e200\Mediavel\MediaLibrary;
use Illuminate\Routing\Controller;

class ImageController extends Controller
{
    protected $mediaLibrary;

    public function __construct(MediaLibrary $mediaLibrary)
    {
        $this->mediaLibrary = $mediaLibrary;
    }

    public function resolve(Request $request)
    {
        try {
            $request->validate(
                [
                    'image' => 'bail|required|mimes:jpeg,jpg,png,gif,svg|max:5012',
                ],
                [
                    'image.required' => 'Image must be provided',
                    'image.mimes'    => 'Only jpg, png, gif and svg images are allowed',
                    'image.size'     => 'MImage greater then max allowed size (5mb)',
                ]
            );

            $image = $this->mediaLibrary->add($request->image);

            return response()->json($image);
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
