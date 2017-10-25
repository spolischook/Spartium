<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\Spartium\Tests;

use PHPUnit\Framework\TestCase;
use Spolischook\Spartium\ImageUploader;
use Spolischook\Spartium\Model\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ImageUploaderTest extends TestCase
{
    public function testEmptyUpload()
    {
        $loader = new ImageUploader();
        $image = $loader->upload(Request::create(''));

        self::assertNull($image);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage You should specify base path first
     */
    public function testBasePathException()
    {
        $loader = new ImageUploader();
        $loader->upload($this->createRequest());
    }

    public function testUpload()
    {
        $loader = new ImageUploader();
        $loader->setBasePath(sys_get_temp_dir());

        $request = $this->createRequest();
        $image = $loader->upload($request);

        self::assertInstanceOf(Image::class, $image);
    }

    /**
     * @return Request
     */
    private function createRequest()
    {
        $request = Request::create('');
        $request->files->add([
            new UploadedFile(__DIR__.'/files/1024px-Spartium_junceum_Colmenar_Viejo_1.jpg', '', null, null, null, true)
        ]);

        return $request;
    }
}