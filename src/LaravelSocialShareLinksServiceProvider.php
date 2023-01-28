<?php

namespace Chengkangzai\LaravelSocialShareLinks;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSocialShareLinksServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-social-share-links');
    }
}
