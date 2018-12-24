<?php

namespace e200\Mediavel\Contracts;

interface MediaInterface
{
    public function backup() : self;

    public function optimize() : self;

    public function resize($width, $heigth = null) : self;

    public function toCollection($name) : self;
}
