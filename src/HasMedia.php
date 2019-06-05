<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\MediaThumb;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    public function preserveOriginal($value = true)
    {
        $this['preserve_original'] = $value;

        $this->save();

        return $this;
    }

    public function resize($name, array $dimensions, $disk = null)
    {
        if (is_null($disk)) {
            $disk = config('mediavel.disks.default');
        }

        $mediaFile = $this->path;

        $parentFilePath = Storage::disk($disk)->path($mediaFile);

        $image = Image::make($parentFilePath);

        $thumbWidth = $dimensions[0];
        $thumbHeight = $dimensions[1];

        $image->fit($thumbWidth, $thumbHeight);

        $imageWidth = $image->getWidth();
        $imageHeight = $image->getheight();

        $imagePath = null;

        if ($this['preserve_original']) {
            $thumbFile = $this->getThumbFile(
                $mediaFile,
                $imageWidth,
                $imageHeight
            );

            $thumbFilePath = Storage::disk($disk)->path($thumbFile);
        }

        $image->save($thumbFilePath);

        $fileMetas = [
            'size' => $name,
            'width' => $image->getWidth(),
            'height' => $image->getHeight(),
        ];

        $this->thumbs()->create([
            'path' => $thumbFile,
            'mime_type' => $image->mime(),
            'meta' => json_encode($fileMetas),
        ]);

        $image->destroy();

        return $this;
    }

    public function getThumbFile($filename, $width, $height)
    {
        $pathInfo = pathinfo($filename);

        return $pathInfo['dirname'].
                DIRECTORY_SEPARATOR.
                $pathInfo['filename'].
                '-'.
                $width.
                'x'.
                $height.
                '.'.
                $pathInfo['extension'];
    }

    public function thumbs()
    {
        return $this->hasMany(MediaThumb::class, 'media_id');
    }

    public function scopeRegenerateThumbs($disk)
    {
        $this
            ->all()
            ->each(function ($media) {
                $media
                ->thumbs
                ->each(function ($thumb) {
                    $thumb->delete();
                });

                app()->call([$media, 'generateThumbs']);
            });
    }
}
