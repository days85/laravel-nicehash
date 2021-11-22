<?php

namespace Days85\Nicehash\Tests;

use Days85\Nicehash\Facades\Nicehash;
use Days85\Nicehash\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return ['HiveOS' => Nicehash::class];
    }

    protected function getEnvironmentSetUp($app): void
    {
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('nicehash.api_key', env('NICEHASH_API_KEY'));
        $app['config']->set('nicehash.api_secret', env('NICEHASH_API_SECRET'));
        $app['config']->set('nicehash.organization_id', env('NICEHASH_ORGANIZATION_ID'));
    }

    protected function getRigsResponse(): array
    {
        return array (
            'pagination' =>
                array (
                    'page' => 0,
                    'totalPageCount' => 1,
                    'size' => 100,
                ),
            'totalDevices' => 1,
            'totalRigs' => 1,
            'externalBalance' => '0.00046461',
            'totalProfitabilityLocal' => 0,
            'nextPayoutTimestamp' => '2020-10-12T20:00:00Z',
            'unpaidAmount' => '0.00000508',
            'totalProfitability' => 9.000394182612861E-7,
            'miningRigGroups' =>
                array (
                ),
            'miningRigs' =>
                array (
                    0 =>
                        array (
                            'stats' =>
                                array (
                                    0 =>
                                        array (
                                            'timeConnected' => 1602490067125,
                                            'speedRejectedR4NTime' => 0,
                                            'xnsub' => true,
                                            'algorithm' =>
                                                array (
                                                    'enumName' => 'SCRYPT',
                                                    'description' => 'Scrypt',
                                                ),
                                            'proxyId' => 0,
                                            'speedRejectedTotal' => 0,
                                            'speedRejectedR2Stale' => 0,
                                            'speedAccepted' => 1259.8570734933332,
                                            'profitability' => 0,
                                            'speedRejectedR1Target' => 0,
                                            'unpaidAmount' => '0.00000007',
                                            'difficulty' => 262144,
                                            'speedRejectedR5Other' => 0,
                                            'statsTime' => 1602527470000,
                                            'speedRejectedR3Duplicate' => 0,
                                            'market' => 'USA',
                                        ),
                                ),
                            'name' => 'worker1',
                            'profitability' => 9.000394182612861E-7,
                            'unpaidAmount' => '0.00000508',
                            'notifications' =>
                                array (
                                ),
                            'rigId' => 'worker1',
                            'localProfitability' => 0,
                            'minerStatus' => 'MINING',
                            'statusTime' => 1602527470000,
                            'type' => 'UNMANAGED',
                        ),
                ),
            'devicesStatuses' =>
                array (
                    'MINING' => 1,
                ),
            'rigTypes' =>
                array (
                    'UNMANAGED' => 1,
                ),
            'minerStatuses' =>
                array (
                    'MINING' => 1,
                ),
            'externalAddress' => true,
            'path' => '',
            'rigNhmVersions' =>
                array (
                ),
            'btcAddress' => '2NFVHDwJmCdwvqr3yzQLPsPXQE3pvaGxNHR',
        );
    }
}
