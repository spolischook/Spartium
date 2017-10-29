<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    /**
     * @param string $mimeType
     * @return bool
     */
    public function isSupported(string $mimeType);

    /**
     * @param UploadedFile $file
     * @param string $name The new file name
     *
     * @return File|null
     */
    public function save(UploadedFile $file, $name = null);
}
