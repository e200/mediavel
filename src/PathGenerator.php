<?php

namespace e200\Mediavel;

use e200\Mediavel\Contracts\PathGeneratorInterface;

class PathGenerator implements PathGeneratorInterface
{
    public function generate($path = null)
    {
        $currentYear  = date('Y');
        $currentMonth = date('m');
        $currentDay   = date('d');

        $pathParts = [
            $path,
            $currentYear,
            $currentMonth,
            $currentDay,
        ];

        return implode(DIRECTORY_SEPARATOR, $pathParts);
    }
}
