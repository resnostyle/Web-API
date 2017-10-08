<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupLaranZEDb_DB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database setup for LaranZEDb';

    private $_env_db_tmpl = <<<TMP
DB_CONNECTION=%%CON%%
DB_HOST=%%HOST%%
DB_PORT=%%PORT%%
DB_DATABASE=%%DB%%
DB_USERNAME=%%USER%%
DB_PASSWORD=%%PASS%%
TMP;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function _buildConfig($data) {
        $finished = $this->_env_db_tmpl;
        foreach ($data as $key => $val) {
            $finished = str_replace($key, $val, $finished);
        }
        return $finished;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(7);
        $bar->start();
        if (file_exists('.env')) {
            if ($this->confirm('A local .env already exists in this directory, do you wish to overwrite?')) {
                $data['%%CON%%'] = $this->anticipate("DB Connection type?", ['mysql']);
                $bar->advance();
                $data['%%HOST%%'] = $this->anticipate("\n DB Host?", ['localhost', '127.0.0.1']);
                $bar->advance();
                $data['%%PORT%%'] = $this->anticipate("\n DB Port?", ['3306']);
                $bar->advance();
                $data['%%DB%%'] = $this->anticipate("\n DB Name?", ['laranzedb']);
                $bar->advance();
                $data['%%USER%%'] = $this->anticipate("\n DB Username?", ['laranzedb_user']);
                $bar->advance();
                $data['%%PASS%%'] = $this->secret("\n DB Password?");
                $bar->advance();
                $this->info("\n Building config...");
                $config = $this->_buildConfig($data);

                if ($this->confirm('Would you like to view the DB config before writing the file? (note: your password will be visible in the console)')) {
                    $this->comment($config);
                }
                $bar->finish();
            } else {
                $bar->finish();
            }
        }
    }
}
