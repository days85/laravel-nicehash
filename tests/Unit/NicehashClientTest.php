<?php

namespace Days85\Nicehash\Tests\Unit;

use Days85\Nicehash\NicehashClient;
use Ergebnis\Http\Method;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class NicehashClientTest extends \Days85\Nicehash\Tests\TestCase
{
    public function testRequest()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], 'Response body'),
            new RequestException(
                'Error Communicating with Server',
                new Request(Method::GET, 'example\endpoint'),
                new Response(500, [])
            ),
            new Response(201, ['Content-Length' => 0])
        ]);

        $handlerStack = HandlerStack::create($mockHandler);

        $httpClient = new Client(['handler' => $handlerStack]);

        $client = new NicehashClient();
        $response = $client
            ->setHttpClient($httpClient)
            ->setApiUrl('https://example.api')
            ->setDebug(true)
            ->setVerify(true)
            ->setApiKey(config('nicehash.api_key'))
            ->setApiSecret(config('nicehash.api_secret'))
            ->setOrganizationId(config('nicehash.organization_id'))
            ->request(Method::GET, 'example\endpoint');
        $this->assertEquals(200, $response->getStatusCode());

        $response = $client->request(Method::GET, 'example\endpoint');
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertEquals('Error Communicating with Server', $response->getDecodedBody());

        $response = $client->request(Method::POST, 'example\endpoint');
        $this->assertEquals(201, $response->getStatusCode());

        $client->setHeader('SOME HEADER', '123');
        $this->assertEquals('123', $client->getHeaders()['SOME HEADER']);

        $client->removeHeader('SOME HEADER');
        $this->assertArrayNotHasKey('SOME HEADER', $client->getHeaders());
    }
}
