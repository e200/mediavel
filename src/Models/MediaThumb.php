<?php

namespace e200\Mediavel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaThumb extends Model
{
    protected $fillable = [
        'path',
        'mime_type',
        'parent_id',
        'meta'
    ];

    /**
     * Makes the dynamic property `url`
     * available in JSON responses
     */
    protected $appends = [
        'url'
    ];

    /**
     * Dynamic property to get the
     * absolute URL
     *
     * @see https://todolink.com/laravel-dynamic-properties
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
