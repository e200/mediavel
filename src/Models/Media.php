<?php

namespace e200\Mediavel\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use MediaTrait;

    protected $fillable = [
        'client_name',
        'file_path',
        'mime_type_id',
    ];

    public function mimeType()
    {
        return $this->belongsTo(MimeType::class);
    }

    public function getDirPath()
    {
        $fileName = self::$file_name;

        return dirname($fileName);
    }
}
