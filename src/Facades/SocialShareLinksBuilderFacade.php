<?php

namespace Chengkangzai\LaravelSocialShareLinks\Facades;

use Chengkangzai\LaravelSocialShareLinks\SocialShareLinksBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @see SocialShareLinksBuilder
 */
class SocialShareLinksBuilderFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SocialShareLinksBuilder::class;
    }
}
