<?php

namespace Days85\Nicehash;

use Carbon\Carbon;
use Ergebnis\Http\Method;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class NicehashClient
{
    /**
     * @var Client
     */
    protected Client $httpClient;

    /**
     * @var string
     */
    protected string $apiUrl = "https://api2.nicehash.com/";

    /**
     * @var string
     */
    protected string $apiKey;

    /**
     * @var string
     */
    protected string $apiSecret;

    /**
     * @var string
     */
    protected string $organizationId;

    /**
     * @var array
     */
    protected array $headers = [];

    /**
     * @var bool
     */
    protected bool $verify = false;

    /**
     * @var bool
     */
    protected bool $debug = false;

    public function __construct()
    {
        $this->initializeHttpClient();
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return NicehashClient
     */
    public function setApiUrl(string $apiUrl): NicehashClient
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return NicehashClient
     */
    public function setApiKey(string $apiKey): NicehashClient
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     * @return NicehashClient
     */
    public function setApiSecret(string $apiSecret): NicehashClient
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * @param string $organizationId
     * @return NicehashClient
     */
    public function setOrganizationId(string $organizationId): NicehashClient
    {
        $this->organizationId = $organizationId;
        return $this;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @param Client $httpClient
     * @return NicehashClient
     */
    public function setHttpClient(Client $httpClient): NicehashClient
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @param string $value
     * @return NicehashClient
     */
    public function setHeader(string $name, string $value): NicehashClient
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function removeHeader(string $key): NicehashClient
    {
        if (isset($this->headers[$key])) {
            unset($this->headers[$key]);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isVerify(): bool
    {
        return $this->verify;
    }

    /**
     * @param bool $verify
     * @return NicehashClient
     */
    public function setVerify(bool $verify): NicehashClient
    {
        $this->verify = $verify;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     * @return NicehashClient
     */
    public function setDebug(bool $debug): NicehashClient
    {
        $this->debug = $debug;
        return $this;
    }

    protected function getParamsOptionName(string $method): string
    {
        return match ($method) {
            Method::GET => 'query',
            Method::POST, Method::PUT, Method::DELETE, Method::PATCH => 'form_params',
            default => '',
        };
    }

    public function initializeHttpClient(): NicehashClient
    {
        $this->setHttpClient(new Client([
            'base_uri' => $this->getApiUrl()
        ]));

        return $this;
    }

    public function request(
        string $method = Method::GET,
        string $endpoint = '',
        array $params = []
    ): NicehashResponse {
        $time = Carbon::now('UTC')->getPreciseTimestamp(3);
        $nonce = uniqid();
        $signature = $this->getApiKey() . "\x00" . $time . "\x00" . $nonce . "\x00" . "\x00" .
            $this->getOrganizationId() . "\x00" . "\x00" . $method . "\x00" . $endpoint;
        $signHash = hash_hmac('sha256', $signature, $this->getApiSecret());
        $xAuth = $this->getApiKey() . ':' . $signHash;

        $this->setHeader('X-Time', $time);
        $this->setHeader('X-Nonce', $nonce);
        $this->setHeader('X-Organization-Id', $this->getOrganizationId());
        $this->setHeader('X-Request-Id', $nonce);
        $this->setHeader('X-Auth', $xAuth);

        $options = [
            'headers' => $this->getHeaders(),
            'verify'  => $this->isVerify(),
            'debug'  => $this->isDebug(),
            $this->getParamsOptionName($method) => $params
        ];

        try {
            $response = $this->getHttpClient()->request($method, $endpoint, $options);
        } catch (GuzzleException $e) {
            $response = new Response(
                $e->getCode(),
                [],
                json_encode($e->getMessage())
            );
        }
        return new NicehashResponse($response);
    }
}
