<?php

namespace e200\Mediavel;

use e200\Mediavel\Models\Media;
use Illuminate\Support\ServiceProvider;
use e200\Mediavel\Factories\MediaFactory;
use e200\Mediavel\Commands\MediavelCommand;
use e200\Mediavel\Contracts\MediaInterface;
use Intervention\Image\ImageServiceProvider;
use e200\Mediavel\Contracts\StorageInterface;
use e200\Mediavel\Contracts\MediaInfoInterface;
use e200\Mediavel\Contracts\MediaFactoryInterface;
use e200\Mediavel\Contracts\MediaResolverInterface;
use e200\Mediavel\Contracts\MediaValidatorInterface;

class MediavelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'e200');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'e200');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/Http/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mediavel.php', 'mediavel');

        // Register the service the package provides.
        $this->app->singleton('mediavel', function ($app) {
            return new Mediavel;
        });

        $this->app->bind(MediaResolverInterface::class, MediaResolver::class);
        $this->app->bind(MediaInterface::class, Media::class);
        $this->app->bind(MediaInfoInterface::class, MediaInfo::class);
        $this->app->bind(MediaValidatorInterface::class, MediaValidator::class);
        $this->app->bind(MediaFactoryInterface::class, MediaFactory::class);
        $this->app->bind(StorageInterface::class, DiskStorage::class);

        $this->app->singleton('mediaLibrary', function ($app) {
            return $app->make(MediaLibrary::class);
        });

        $this->app->register(ImageServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mediavel'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/mediavel.php' => config_path('mediavel.php'),
        ], 'mediavel.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/e200'),
        ], 'mediavel.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/e200'),
        ], 'mediavel.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/e200'),
        ], 'mediavel.views');*/

        // Registering package commands.
        $this->commands([
            MediavelCommand::class,
        ]);
    }
}
