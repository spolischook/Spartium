<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\UploadedFileHandler\Model;

interface ImageOwnerInterface
{
    /**
     * Returns unique identify of image owner, e.g. user
     *
     * @return string|int
     */
    public function getId();
}