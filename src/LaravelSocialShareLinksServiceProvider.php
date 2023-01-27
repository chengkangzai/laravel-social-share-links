<?php

namespace Chengkangzai\LaravelSocialShareLinks;

use Chengkangzai\LaravelSocialShareLinks\Commands\LaravelSocialShareLinksCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile();
    }
}
