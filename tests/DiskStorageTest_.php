<?php

namespace e200\Mediavel\Tests;

use Mockery;
use e200\Mediavel\LocalStorage;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Storage;

class DiskStorageTest extends TestCase
{
    public function testMakeStorageRelativePath()
    {
        $localStorage = $this->getInstance();

        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageDirPath = $localStorage->makeStorageRelativePath();

        $this->assertNotEmpty($storageDirPath);

        $pathParts = explode(DIRECTORY_SEPARATOR, $storageDirPath);

        $this->assertCount(3, $pathParts);

        $this->assertEquals($currentYear, $pathParts[0]);
        $this->assertEquals($currentMonth, $pathParts[1]);
        $this->assertNotEmpty($pathParts[2]);
        $this->assertEquals(10, strlen($pathParts[2]));
    }

    public function testStore()
    {
        $localStorage = $this->getInstance();
        $diskName = 'public';

        $fakeUploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $filePath = $localStorage->store($fakeUploadedFile, $diskName);

        Storage::disk($diskName)->assertExists($filePath);
    }

    protected function getInstance()
    {
        return new LocalStorage();
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        // $app['config']->set('mediavel.storage.path', $this->root->url());
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
