<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Controller;

use Spartium\UploadedFileHandler\FileUploaderInterface;
use Spartium\UploadedFileHandler\Handlers\UploaderCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController
{
    /**
     * @var UploaderCollection
     */
    private $uploaderCollection;

    public function __construct(UploaderCollection $uploaderCollection)
    {
        $this->uploaderCollection = $uploaderCollection;
    }

    public function uploadAction(Request $request)
    {
        if (!$request->files->count()) {
            return new Response('No content', Response::HTTP_NO_CONTENT);
        }

        $files = [];

        /** @var UploadedFile $file */
        foreach ($request->files->all() as $file) {
            $fileUploader = $this->uploaderCollection->get($file->getMimeType());
            if (null === $fileUploader) {
                // Not supported file
                // todo: Create not supported File for response
                continue;
            }

            $files[] = $fileUploader->save($file);
        }

        return new JsonResponse(
            array_map(
                function (File $file) {
                    return $file->getRealPath();
                },
                $files
            ),
            Response::HTTP_CREATED
        );
    }
}
