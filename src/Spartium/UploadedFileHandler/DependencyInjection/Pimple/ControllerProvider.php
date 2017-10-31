<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\DependencyInjection\Pimple;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\Provider\ServiceControllerServiceProvider;

class ControllerProvider implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $app->register(new ServiceControllerServiceProvider());
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () {
            return <<<HTML
<html>
<body>
    <h1>Hello World!</h1>
    <form method="post" action="/files/upload" enctype="multipart/form-data">
        <input name="files" type="file" multiple>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
HTML;
        });
        $controllers->post('/upload', 'spartium.uploaded_file_handler.controller.upload:uploadAction')
            ->when("request.headers.contains('Accept', 'application/json')")
        ;

        return $controllers;
    }
}
