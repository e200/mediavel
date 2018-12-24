<?php

namespace e200\Mediavel\Tests\Commands;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Artisan;
use e200\Mediavel\MediavelServiceProvider;

class MediavelCommandTest extends TestCase
{
    public function testInstall()
    {
        Artisan::call('mediavel:handle');

        $this->assertTrue(true);
    }

    protected function getPackageProviders($app)
    {
        return [MediavelServiceProvider::class];
    }
}
