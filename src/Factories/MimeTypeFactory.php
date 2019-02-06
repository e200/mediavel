<?php

namespace e200\Mediavel\Factories;

use e200\Mediavel\Models\MimeType;
use e200\Mediavel\Contracts\Factories\MimeTypeFactoryInterface;

class MimeTypeFactory implements MimeTypeFactoryInterface
{
    public function make($value)
    {
        $mimeType = app(MimeType::class);

        $mimeType->value = $value;

        $mimeType->save();

        return $mimeType;
    }
}