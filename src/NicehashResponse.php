<?php

namespace Days85\Nicehash;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class NicehashResponse
{
    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @var StreamInterface
     */
    protected StreamInterface $body;

    /**
     * @var string[][]
     */
    protected array $headers;

    /**
     * @var mixed
     */
    protected mixed $decodedBody;

    public function __construct(ResponseInterface $response)
    {
        $this->setStatusCode($response->getStatusCode());
        $this->setBody($response->getBody());
        $this->setHeaders($response->getHeaders());
        $this->decodeBody();
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return NicehashResponse
     */
    public function setStatusCode(int $statusCode): NicehashResponse
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return StreamInterface
     */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }

    /**
     * @param StreamInterface $body
     * @return NicehashResponse
     */
    public function setBody(StreamInterface $body): NicehashResponse
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string[][] $headers
     * @return NicehashResponse
     */
    public function setHeaders(array $headers): NicehashResponse
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDecodedBody(): mixed
    {
        return $this->decodedBody;
    }

    /**
     * @param mixed $decodedBody
     * @return NicehashResponse
     */
    public function setDecodedBody(mixed $decodedBody): NicehashResponse
    {
        $this->decodedBody = $decodedBody;
        return $this;
    }

    public function decodeBody(): NicehashResponse
    {
        $this->setDecodedBody(json_decode($this->getBody(), true));

        return $this;
    }
}
