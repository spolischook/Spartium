<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Handlers\Image;

use Spartium\UploadedFileHandler\AbstractUploader;
use Spartium\UploadedFileHandler\FileUploaderInterface;
use Spartium\UploadedFileHandler\Model\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader extends AbstractUploader implements FileUploaderInterface
{
    protected $mimeTypes = [
        'image/png',
        'image/jpeg',
    ];

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @param string $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAcceptedMimeTypes()
    {
        return $this->mimeTypes;
    }

    /**
     * {@inheritdoc}
     * @return Image|null
     */
    public function save(UploadedFile $file, $name = null)
    {
        if (!$this->basePath) {
            throw new \InvalidArgumentException('You should specify base path first');
        }

        $newFile = $file->move($this->basePath, $name);

        return new Image($newFile->getRealPath());
    }
}
