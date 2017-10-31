<?php
/**
 * This file is part of the Spartium.
 * (c) Serhii Polishchuk <spolischook@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Spartium\UploadedFileHandler\Tests\Functional;

use Symfony\Component\HttpFoundation\Response;

class UploadControllerTest extends WebTestCase
{
    public function testForm()
    {
        $client = $this->createClient();
        $client->followRedirects();
        $client->request('GET', '/files', ['HTTP_ACCEPT' => 'application/json']);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testEmptyJsonRequest()
    {
        $client = $this->createClient();
        $client->followRedirects();
        try {
            $client->request('POST', '/files/upload', [], [], ['HTTP_ACCEPT' => 'application/json']);
        } catch (\Exception $e) {
            var_dump($client->getRequest());
            throw $e;
        }

        $this->assertEquals(Response::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());
    }
}
