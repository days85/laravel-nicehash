<?php

namespace Days85\Nicehash;

use Days85\Nicehash\Models\Requests\MiningRigsParams;
use Days85\Nicehash\Models\Requests\MiningRigsPayoutsParams;
use Ergebnis\Http\Method;

class Nicehash
{
    protected NicehashClient $client;

    protected bool $debug = false;

    protected bool $verify = false;

    /**
     * Constructor
     *
     * @param array $config
     * @param NicehashClient|null $client
     */
    public function __construct(array $config, NicehashClient $client = null)
    {
        if (is_null($client)) {
            $client = new NicehashClient();
            $client
                ->setApiKey($config['api_key'])
                ->setApiSecret($config['api_secret'])
                ->setOrganizationId($config['organization_id']);
        }

        $this->client = $client;
    }

    /**
     * @return NicehashClient|null
     */
    public function getClient(): ?NicehashClient
    {
        return $this->client;
    }

    /**
     * @param NicehashClient|null $client
     * @return Nicehash
     */
    public function setClient(?NicehashClient $client): Nicehash
    {
        $this->client = $client;
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
     * @return Nicehash
     */
    public function setDebug(bool $debug): Nicehash
    {
        $this->debug = $debug;
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
     * @return Nicehash
     */
    public function setVerify(bool $verify): Nicehash
    {
        $this->verify = $verify;
        return $this;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array  $params
     * @return mixed
     */
    protected function request(
        string $method = Method::GET,
        string $endpoint = '',
        array $params = []
    ): mixed {

        $this->client->setDebug($this->isDebug());
        $this->client->setVerify($this->isVerify());

        $response =  $this->client->request($method, $endpoint, $params);

        return $response->getDecodedBody();
    }

    /**
     * List rigs and their statuses. Path parameter filters rigs by group.
     * When path is empty, rigs from root group are returned.
     * Rigs can be sorted according to sort parameter.
     *
     * @param MiningRigsParams|null $params
     * @return mixed
     */
    public function miningRigs(MiningRigsParams $params = null): mixed
    {
        $paramsArray = [];
        if ($params) {
            $paramsArray = $params->toArray();
        }

        return $this->request(Method::GET, NicehashEndpoints::MINING_RIGS, $paramsArray);
    }

    /**
     * $paramsArray
     *
     * @param MiningRigsPayoutsParams|null $params
     * @return mixed
     */
    public function miningRigsPayouts(MiningRigsPayoutsParams $params = null): mixed
    {
        $paramsArray = [];
        if ($params) {
            $paramsArray = $params->toArray();
        }

        return $this->request(Method::GET, NicehashEndpoints::MINING_RIGS_PAYOUTS, $paramsArray);
    }
}
