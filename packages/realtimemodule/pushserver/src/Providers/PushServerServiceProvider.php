<?php
namespace realtimemodule\pushserver\Providers;
use Illuminate\Support\ServiceProvider;
class PushServerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return voids
     */
    public function register()
    {
        $this->commands([
            \realtimemodule\pushserver\Commands\PushServer::class
        ]);
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}