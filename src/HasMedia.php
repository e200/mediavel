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

    public function resize($sizeName, array $dimensions, $disk = null)
    {
        $mediaRelativePath = $this['relative_path'];

        $resizeWidth = $dimensions[0];
        $resizeHeight = $dimensions[1];

        $disk = $disk ?? $disk = config('mediavel.disks.default');

        $mediaAbsolutePath = $this->getAbsolutePath($mediaRelativePath, $disk);

        $image = Image::make($mediaAbsolutePath);

        $image->fit($resizeWidth, $resizeHeight);

        $imageWidth = $image->getWidth();
        $imageHeight = $image->getHeight();

        $mediaArgs = [
            'width' => $image->getWidth(),
            'height' => $image->getHeight(),
            'size_name' => $sizeName
        ];

        if ($this['preserve_original']) {
            $thumbRelativePath = $this->getThumbFile(
                $mediaRelativePath,
                $imageWidth,
                $imageHeight
            );

            $thumbAbsolutePath = $this->getAbsolutePath($thumbRelativePath, $disk);

            $mediaArgs['relative_path'] = $thumbRelativePath;

            $this->thumbs()->create($mediaArgs);

            $image->save($thumbAbsolutePath);
        } else {
            $mediaArgs['relative_path'] = $mediaRelativePath;

            $this->update($mediaArgs);

            $this->save();

            $image->save();
        }

        $image->destroy();

        return $this;
    }

    protected function getThumbFile($filename, $width, $height)
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

    protected function getAbsolutePath($filename, $disk)
    {
        return Storage::disk($disk)->path($filename);
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
