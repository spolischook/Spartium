<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler;

abstract class AbstractUploader implements FileUploaderInterface
{
    /**
     * @var array
     */
    protected $mimeTypes = [];

    /**
     * {@inheritdoc}
     */
    public function isSupported(string $mimeType)
    {
        return in_array($mimeType, $this->getAcceptedMimeTypes());
    }

    /**
     * Get array of available MimeTypes
     *
     * @return string[]
     */
    abstract protected function getAcceptedMimeTypes();
}
