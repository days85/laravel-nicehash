<?php

namespace Days85\Nicehash\Tests\Unit;

use Days85\Nicehash\Nicehash;
use Days85\Nicehash\NicehashClient;
use Days85\Nicehash\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class NicehashTest extends TestCase
{
    public function testRigs()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($this->getRigsResponse())),
        ]);

        $handlerStack = HandlerStack::create($mockHandler);

        $httpClient = new Client(['handler' => $handlerStack]);

        $clientMock  = new NicehashClient();
        $clientMock
            ->setHttpClient($httpClient)
            ->setDebug(true)
            ->setApiKey(config('nicehash.api_key'))
            ->setApiSecret(config('nicehash.api_secret'))
            ->setOrganizationId(config('nicehash.organization_id'));

        $nicehash = new Nicehash(config('nicehash'));
        $nicehash->setClient($clientMock);
        $nicehash->setDebug(true);
        $nicehash->setVerify(true);
        $this->assertInstanceOf(NicehashClient::class, $nicehash->getClient());

        $response = $nicehash->rigs();

        $this->assertEquals($this->getRigsResponse(), $response);
    }
}
