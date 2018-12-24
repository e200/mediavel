<?php

namespace e200\Mediavel;

use Illuminate\Http\Request;

class FileHandler
{
    public function handle(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,dox'
        ]);
    }
}
