<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\DependencyInjection\Pimple;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Spartium\UploadedFileHandler\Controller\UploadController;
use Spartium\UploadedFileHandler\Handlers\Image\ImageUploader;
use Spartium\UploadedFileHandler\Handlers\UploaderCollection;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $app)
    {
        $app['spartium.uploaded_file_handler.image_uploader'] = function () {
            $imageUploader = new ImageUploader();
            $imageUploader->setBasePath(sys_get_temp_dir());

            return $imageUploader;
        };

        $app['spartium.uploaded_file_handler.uploader_collection'] = function () use ($app) {
            return UploaderCollection::create()
                ->register($app['spartium.uploaded_file_handler.image_uploader']);
        };

        $app['spartium.uploaded_file_handler.controller.upload'] = function () use ($app) {
            return new UploadController(
                $app['spartium.uploaded_file_handler.uploader_collection']
            );
        };
    }
}
