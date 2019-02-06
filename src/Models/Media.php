<?php

namespace e200\Mediavel\Models;

use e200\Mediavel\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use e200\Mediavel\Contracts\MediaInterface;

class Media extends Model implements MediaInterface
{
    use MediaTrait;

    protected $table = 'medias';

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
