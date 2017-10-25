<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spolischook\Spartium;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

interface FileUploaderInterface
{
    /**
     * @param string $basePath
     * @return $this
     */
    public function setBasePath($basePath);

    /**
     * @param Request $request
     * @return File|null
     */
    public function upload(Request $request);
}