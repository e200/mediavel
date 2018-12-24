<?php

namespace e200\Mediavel\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'client_name',
        'file_name',
    ];
}
