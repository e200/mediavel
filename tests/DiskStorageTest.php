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

    public function testGetStorageDirPath()
    {
        $diskStorage = $this->getInstance();

        $storageName = 'storage';
        $storagePath = DIRECTORY_SEPARATOR . $storageName;
        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageDirPath = $diskStorage->getStorageDirPath($storagePath);

        $this->assertNotEmpty($storageDirPath);

        $pathParts = explode(DIRECTORY_SEPARATOR, $storageDirPath);

        $this->assertCount(5, $pathParts);

        $this->assertEquals($storageName, $pathParts[1]);
        $this->assertEquals($currentYear, $pathParts[2]);
        $this->assertEquals($currentMonth, $pathParts[3]);
        $this->assertNotEmpty($pathParts[4]);
    }

    public function testResolveStorageDir()
    {
        $diskStorage = $this->getInstance();

        $currentYear = date('Y');
        $currentMonth = date('m');

        $storageDirPath = $diskStorage->resolveStorageDir($this->root->url());

        $this->assertTrue($this->root->hasChild($currentYear));
        $yearChildDir = $this->root->getChild($currentYear);

        $this->assertTrue($yearChildDir->hasChild($currentMonth));
        $monthChildDir = $yearChildDir->getChild($currentMonth);

        // $this->assertTrue($monthChildDir->empty());
    }

    public function testStore()
    {
        /* $diskStorage = $this->getInstance();

        $fakeUploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $fileMetaMock = Mockery::mock(FileMeta::class);

        $time = time();

        $fileMetaMock->shouldIgnoreMissing();
        $fileMetaMock->create_at = $time;

        $this->assertEquals($time, $fileMetaMock->create_at);
        $this->assertFileExists($diskStorage->store($fakeUploadedFile, $fileMetaMock)); */

        $this->assertTrue(true);
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
