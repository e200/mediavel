<?php

namespace e200\Mediavel\Contracts;

interface MediaInterface
{
    public function backup() : MediaInterface;
    public function optimize() : MediaInterface;
    public function resize($width, $heigth = null) : MediaInterface;
    public function toCollection($name) : MediaInterface;
}
