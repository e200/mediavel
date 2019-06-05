<?php

namespace e200\Mediavel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaThumb extends Model
{
    protected $fillable = [
        'relative_path',
        'media_id',
        'width',
        'height',
        'size_name',
        'mime_type',
    ];

    /**
     * Makes the dynamic property `url`
     * available in JSON responses.
     */
    protected $appends = [
        'url',
    ];

    /**
     * Dynamic property to get the
     * absolute URL.
     *
     * @see https://todolink.com/laravel-dynamic-properties
     */
    public function getUrlAttribute()
    {
        $disk = config('mediavel.disks.default');

        return Storage::url($this['relative_path'], $disk);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
