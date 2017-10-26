<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler\Tests;

use PHPUnit\Framework\TestCase;
use Spolischook\UploadedFileHandler\ImageUploader;
use Spolischook\UploadedFileHandler\Model\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploaderTest extends TestCase
{
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

        $request = $this->getUploadedFile();
        $image = $loader->save($request);

        self::assertInstanceOf(Image::class, $image);
    }

    /**
     * @return UploadedFile
     */
    private function getUploadedFile()
    {
         return new UploadedFile(
             __DIR__.'/files/1024px-Spartium_junceum_Colmenar_Viejo_1.jpg',
             '',
             null,
             null,
             null,
             true
         );
    }
}