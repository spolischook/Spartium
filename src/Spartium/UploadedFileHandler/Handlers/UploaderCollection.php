<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Handlers;

use Spartium\UploadedFileHandler\FileUploaderInterface;

class UploaderCollection
{
    /**
     * @var FileUploaderInterface[]
     */
    protected $uploaders;

    /**
     * @return UploaderCollection
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @param FileUploaderInterface $uploader
     * @return $this
     */
    public function register(FileUploaderInterface $uploader)
    {
        $this->uploaders = $uploader;

        return $this;
    }

    /**
     * @param string $mimeType
     * @return null|FileUploaderInterface
     */
    public function get(string $mimeType): ?FileUploaderInterface
    {
        foreach ($this->uploaders as $uploader) {
            if ($uploader->isSupported($mimeType)) {
                return $uploader;
            }
        }

        return null;
    }
}
