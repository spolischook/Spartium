<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler\Model;

use Symfony\Component\HttpFoundation\File\File;

class Image extends File
{
    const TYPE_ORIG = 'original';
    const TYPE_THUMB = 'thumbnail';

    /**
     * @var ImageOwnerInterface
     */
    protected $owner;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var File
     */
    protected $file;

    /**
     * @var Image[]
     */
    protected $thumbnails = [];
}