<?php
namespace crawlmodule\loterie\Providers;
use Illuminate\Support\ServiceProvider;
class LoterieServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return voids
     */
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/routes.php');
    }
}