<?php

namespace e200\Mediavel\Models;

use e200\Mediavel\Models\MimeType;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';

    protected $fillable = [
        'client_name',
        'file_name',
        'mime_type_id'
    ];

    public function mimeType()
    {
        return $this->belongsTo(MimeType::class);
    }
}
