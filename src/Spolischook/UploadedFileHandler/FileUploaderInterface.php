<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    /**
     * @param UploadedFile $file
     * @return bool
     */
    public function isSupported(UploadedFile $file);

    /**
     * @param UploadedFile $file
     * @return File|null
     */
    public function save(UploadedFile $file);
}