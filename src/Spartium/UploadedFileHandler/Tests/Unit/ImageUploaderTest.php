<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spartium\UploadedFileHandler\Handlers\Image\ImageUploader;
use Spartium\UploadedFileHandler\Model\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploaderTest extends TestCase
{
    const SOURCE_FILE = __DIR__.'/../files/1024px-Spartium_junceum_Colmenar_Viejo_1.jpg';

    private $tmpFile;

    protected function setUp()
    {
        $this->tmpFile = tempnam(sys_get_temp_dir(), 'test_image_');
        fwrite(fopen($this->tmpFile, 'w+'), file_get_contents(self::SOURCE_FILE));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage You should specify base path first
     */
    public function testBasePathException()
    {
        $loader = new ImageUploader();
        $loader->save($this->getUploadedFile());
    }

    public function testUpload()
    {
        $loader = new ImageUploader();
        $loader->setBasePath(sys_get_temp_dir());

        $uploadedFile = $this->getUploadedFile();
        $image = $loader->save($uploadedFile);

        self::assertInstanceOf(Image::class, $image);
        self::assertEquals($this->tmpFile, $image->getRealPath());
    }

    public function testUploadWithNewName()
    {
        $loader = new ImageUploader();
        $loader->setBasePath(sys_get_temp_dir());

        $newFileName = uniqid('image_', true).'.jpg';
        $uploadedFile = $this->getUploadedFile();
        $image = $loader->save($uploadedFile, $newFileName);

        self::assertInstanceOf(Image::class, $image);
        self::assertEquals($newFileName, $image->getBasename());

        //for correct delete file
        $this->tmpFile = $image->getRealPath();
    }

    /**
     * @return UploadedFile
     */
    private function getUploadedFile()
    {
        return new UploadedFile(
            $this->tmpFile,
            '',
            null,
            null,
            null,
            true
        );
    }

    protected function tearDown()
    {
        unlink($this->tmpFile);
    }
}
