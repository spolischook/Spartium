<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler;

use Intervention\Image\ImageManager;

class ThumbnailMaker
{
    /**
     * @var ImageManager
     */
    protected $imageManager;

    /**
     * @var array
     */
    protected $configuration;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * @param string $name
     * @param array $config
     * @return void
     */
    public function addConfig(string $name, array $config)
    {
        $this->configuration[$name] = $config;
    }
}