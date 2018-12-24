<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\Media as MediaModel;
use e200\Mediavel\Contracts\MediaInterface;

class Media implements MediaInterface
{
    protected $model;

    public function __construct(MediaModel $model)
    {
        $this->model = $model;
    }

    public function backup() : MediaInterface
    {
        return $this;
    }

    public function optimize() : MediaInterface
    {
        return $this;
    }

    public function resize($width, $heigth = null) : MediaInterface
    {
        return $this;
    }

    public function toCollection($name) : MediaInterface
    {
        return $this;
    }
}
