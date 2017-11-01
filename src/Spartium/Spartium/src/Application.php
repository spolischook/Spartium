<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\Spartium;

use Silex\Application as SilexApplication;
use Spartium\UploadedFileHandler\DependencyInjection\Pimple\ControllerProvider;
use Spartium\UploadedFileHandler\DependencyInjection\Pimple\ServiceProvider;

class Application extends SilexApplication
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->register(new ServiceProvider());
        $this->mount('/files', new ControllerProvider());
    }
}
