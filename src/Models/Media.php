<?php

namespace e200\Mediavel\Models;

use e200\Mediavel\HasThumbs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasThumbs;

    protected $fillable = [
        'name',
        'path',
        'mime_type',
        'parent_id',
        'meta',
        'user_id',
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
    public function mediable()
    {
        return $this->morphTo();
    }

    /**
     * Dynamic property to get the
     * absolute URL.
     *
     * @see https://todolink.com/laravel-dynamic-properties
     */
    public function getUrlAttribute()
    {
        $disk = config('mediavel.disks.default');

        return Storage::url($this->path, $disk);
    }
}
