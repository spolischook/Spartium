<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler;

use Spolischook\UploadedFileHandler\Model\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader implements FileUploaderInterface
{
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
     * @return Image|null
     */
    public function save(UploadedFile $file)
    {
        if (!$this->basePath) {
            throw new \InvalidArgumentException('You should specify base path first');
        }

        return new Image('/', false);
    }
}
