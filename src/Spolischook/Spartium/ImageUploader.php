<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\Spartium;

use Spolischook\Spartium\Model\Image;
use Symfony\Component\HttpFoundation\Request;

class ImageUploader implements FileUploaderInterface
{
    /**
     * @var ThumbnailMaker
     */
    private $thumbnailMaker;

    public function __construct(ThumbnailMaker $thumbnailMaker)
    {
        $this->thumbnailMaker = $thumbnailMaker;
    }

    /**
     * @var string
     */
    protected $basePath;

    /**
     * {@inheritdoc}
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
    public function upload(Request $request)
    {
        $files = $request->files;

        if (empty($files->all())) {
            return null;
        }

        if (!$this->basePath) {
            throw new \InvalidArgumentException('You should specify base path first');
        }

        return new Image('/', false);
    }
}
