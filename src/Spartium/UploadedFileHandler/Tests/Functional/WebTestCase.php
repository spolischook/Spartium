<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Tests\Functional;

use Silex\Application;
use Silex\WebTestCase as SilexWebTestCase;
use Spartium\UploadedFileHandler\DependencyInjection\Pimple\ControllerProvider;
use Spartium\UploadedFileHandler\DependencyInjection\Pimple\ServiceProvider;

class WebTestCase extends SilexWebTestCase
{
    /**
     * {@inheritdoc}
     */
    public function createApplication()
    {
        $app = new Application();
        $app['debug'] = true;
        unset($app['exception_handler']);

        $app->register(new ServiceProvider());

        $app->mount('/files', new ControllerProvider());

        return $app;
    }
}
