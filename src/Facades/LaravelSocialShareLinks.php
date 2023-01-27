<?php

namespace Chengkangzai\LaravelSocialShareLinks\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chengkangzai\LaravelSocialShareLinks\LaravelSocialShareLinks
 */
class LaravelSocialShareLinks extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Chengkangzai\LaravelSocialShareLinks\LaravelSocialShareLinks::class;
    }
}
