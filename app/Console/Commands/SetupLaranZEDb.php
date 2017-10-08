<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupLaranZEDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run ALL the necessary setup for a new LaranZEDb installation.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
