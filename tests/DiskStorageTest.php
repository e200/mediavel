<?php

namespace e200\Mediavel\Tests;

use Mockery;
use org\bovigo\vfs\vfsStream;
use e200\Mediavel\DiskStorage;
use Illuminate\Http\UploadedFile;
use Orchestra\Testbench\TestCase;
use e200\Mediavel\Models\FileMeta;
use Illuminate\Support\Facades\Storage;

class DiskStorageTest extends TestCase
{
    protected $root;

    public function testMakeStorageRelativePath()
    {
        $diskStorage = $this->getInstance();

        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageDirPath = $diskStorage->makeStorageRelativePath();

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
        $diskStorage = $this->getInstance();

        $fakeUploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $filePath = $diskStorage->store($fakeUploadedFile);

        Storage::assertExists($filePath);
    }

    protected function getInstance()
    {
        return new DiskStorage();
    }

    protected function getEnvironmentSetUp($app)
    {
        $this->root = vfsStream::setup('/storage');

        // Setup default database to use sqlite :memory:
        $app['config']->set('mediavel.storage.path', $this->root->url());
    }

    protected function tearDown()
    {
        Mockery::close();
    }
}
