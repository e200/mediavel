<?php

namespace e200\Mediavel\Commands;

use Illuminate\Console\Command;

class MediavelCommand extends Command
{
    protected $signature = 'mediavel:handle';

    protected $description = 'Bootstraps the Mediavel package';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //
    }
}
