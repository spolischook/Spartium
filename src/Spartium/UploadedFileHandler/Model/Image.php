<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Model;

use Symfony\Component\HttpFoundation\File\File;

class Image extends File
{
    const TYPE_ORIG = 'original';
    const TYPE_THUMB = 'thumbnail';

    /**
     * @var FileOwnerInterface
     */
    protected $owner;

    /**
     * See TYPE_* constants
     *
     * @var string
     */
    protected $type;

    /**
     * @var Image[]
     */
    protected $thumbnails = [];

    /**
     * @return FileOwnerInterface
     */
    public function getOwner(): FileOwnerInterface
    {
        return $this->owner;
    }

    /**
     * @param FileOwnerInterface $owner
     * @return Image
     */
    public function setOwner(FileOwnerInterface $owner): Image
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Image
     */
    public function setType(string $type): Image
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Image[]
     */
    public function getThumbnails(): array
    {
        return $this->thumbnails;
    }

    /**
     * @param Image[] $thumbnails
     * @return Image
     */
    public function setThumbnails(array $thumbnails): Image
    {
        $this->thumbnails = $thumbnails;
        return $this;
    }
}
