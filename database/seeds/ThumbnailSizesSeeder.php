<?php

use Illuminate\Database\Seeder;
use e200\Emediavel\Models\ThumbnailSize;

class ThumbnailSizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getThumbnailSizes() as $thumbnailSize) {
            ThumbnailSize::create($thumbnailSize);
        }
    }

    public function getThumbnailSizes()
    {
        return [
            [
                'key'    => 'small',
                'width'  => 150,
                'heigth' => 150,
            ],
            [
                'key'    => 'medium',
                'width'  => 300,
                'heigth' => 300,
            ],
            [
                'key'    => 'large',
                'width'  => 1024,
                'heigth' => null,
            ],
        ];
    }
}
