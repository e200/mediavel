<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\Media;
use e200\Mediavel\Contracts\MediaResolverInterface;

class MediaResolver implements MediaResolverInterface
{
    protected $model;

    public function __construct(Media $model)
    {
        $this->model = $model;
    }

    public function backup() : MediaResolverInterface
    {
        return $this;
    }

    public function optimize() : MediaResolverInterface
    {
        return $this;
    }

    public function resize($width, $heigth = null) : MediaResolverInterface
    {
        return $this;
    }

    public function toCollection($name) : MediaResolverInterface
    {
        return $this;
    }
}
