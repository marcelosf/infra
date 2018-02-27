<?php

namespace Infra\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Infra\Repositories\Devices\StackRepository::class, \Infra\Repositories\Devices\StackRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Local\LocalRepository::class, \Infra\Repositories\Local\LocalRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Infra\PatchRepository::class, \Infra\Repositories\Infra\PatchRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Infra\PhonesRepository::class, \Infra\Repositories\Infra\PhonesRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Infra\RackRepository::class, \Infra\Repositories\Infra\RackRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Infra\VoicePanelRepository::class, \Infra\Repositories\Infra\VoicePanelRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Infra\VoicePortRepository::class, \Infra\Repositories\Infra\VoicePortRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Devices\SwitchPortsRepository::class, \Infra\Repositories\Devices\SwitchPortsRepositoryEloquent::class);
        $this->app->bind(\Infra\Repositories\Devices\SwitchesRepository::class, \Infra\Repositories\Devices\SwitchesRepositoryEloquent::class);
        //:end-bindings:
    }
}
