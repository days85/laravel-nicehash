<?php

namespace Days85\Nicehash;

use Illuminate\Contracts\Support\DeferrableProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider implements DeferrableProvider
{
    public function boot()
    {
        $configPath = __DIR__ . '/../config/nicehash.php';
        $this->publishes([$configPath => $this->getConfigPath()]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Nicehash::class, function () {
            $config = config('nicehash');
            return new Nicehash($config);
        });
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function getConfigPath(): string
    {
        return config_path('nicehash.php');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [Nicehash::class];
    }
}
