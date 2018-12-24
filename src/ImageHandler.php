<?php

namespace e200\Mediavel;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ImageHandler
{
    public function handle(Request $request)
    {
        try {
            $request->validate(
                [
                    'image' => 'bail|required|mimes:jpeg,jpg,png,gif,svg|max:5012'
                ],
                [
                    'image.required' => 'Image must be provided',
                    'image.mimes'    => 'Only jpg, png, gif and svg images are allowed',
                    'image.size'     => 'MImage greater then max allowed size (5mb)',
                ]
            );

            return true;
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
