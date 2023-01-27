<?php

namespace Chengkangzai\LaravelSocialShareLinks\Commands;

use Illuminate\Console\Command;

class LaravelSocialShareLinksCommand extends Command
{
    public $signature = 'laravel-social-share-links';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
