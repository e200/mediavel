<?php

namespace e200\Mediavel\Contracts;

interface MediaResolverInterface
{
    public function backup() : MediaResolverInterface;
    public function optimize() : MediaResolverInterface;
    public function resize($width, $heigth = null) : MediaResolverInterface;
    public function toCollection($name) : MediaResolverInterface;
}
