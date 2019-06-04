<?php

namespace e200\Mediavel;

use Illuminate\Http\Request;
use e200\Mediavel\Contracts\MediaValidatorInterface;

class MediaValidator implements MediaValidatorInterface
{
    public function validate(Request $request, $field)
    {
        $acceptedFileFormats = [
            'jpeg', 'jpg', 'png',
            'svg',  'ico', 'bmp',
            'gif',  'pdf', 'doc',
            'docx', 'xml',
        ];

        $acceptedFileFormatsString = implode(',', $acceptedFileFormats);

        $validationRules = "bail|required|mimes:$acceptedFileFormatsString|max:5012";

        $request->validate([
            $field => $validationRules,
        ]);
    }
}
