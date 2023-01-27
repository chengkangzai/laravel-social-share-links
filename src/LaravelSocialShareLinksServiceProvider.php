<?php

namespace Chengkangzai\LaravelSocialShareLinks;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Chengkangzai\LaravelSocialShareLinks\Commands\LaravelSocialShareLinksCommand;

class LaravelSocialShareLinksServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-social-share-links')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-social-share-links_table')
            ->hasCommand(LaravelSocialShareLinksCommand::class);
    }
}
