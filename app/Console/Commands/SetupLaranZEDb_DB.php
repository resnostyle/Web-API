<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupLaranZEDb_DB extends Command {

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

    private function _buildConfig($data)
    {
        $finished = $this->_env_db_tmpl;
        foreach ($data as $key => $val) {
            $finished = str_replace($key, $val, $finished);
        }

        return $finished;
    }

    private function _clear()
    {
        if (windows_os()) {
            system('cls');
        } else {
            system('clear');
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->_clear();
        $bar = $this->output->createProgressBar(8);
        $bar->setProgressCharacter("\xf0\x9f\x90\xb1");
        $bar->setBarCharacter("\xf0\x9f\x8f\xb3\xef\xb8\x8f\xe2\x80\x8d\xf0\x9f\x8c\x88");

        $tmpl_setup = [
            '%%CON%%' => [
                'type' => 'choice',
                'question' => 'Database Connection type?',
                'options' => ['mysql', 'postgres', 'sqlite']
            ],
            '%%HOST%%' => [
                'type' => 'anticipate',
                'question' => 'Database Host?',
                'options' => ['localhost', '127.0.0.1']
            ],
            '%%PORT%%' => [
                'type' => 'anticipate',
                'question' => 'Database Port?',
                'options' => [0, 3306, 5432]
            ],
            '%%DB%%' => [
                'type' => 'anticipate',
                'question' => 'Database Name?',
                'options' => ['laranzedb']
            ],
            '%%USER%%' => [
                'type' => 'anticipate',
                'question' => 'Database Username?',
                'options' => ['laranzedb_user']
            ],
            '%%PASS%%' => [
                'type' => 'secret',
                'question' => 'Database Password? (typing not shown for security)'
            ]
        ];

        if (file_exists('.env')) {
            if ( ! $this->confirm('A local .env already exists in this directory, do you wish to overwrite?')) {
                $bar->finish();
                return;
            }
        }

        $result = [];
        foreach ($tmpl_setup as $key => $val) {
            $this->_clear();
            $bar->advance();
            $this->output->writeln("\n");
            switch ($val['type']) {
                case 'anticipate':
                    $result[$key] = $this->anticipate($val['question'], $val['options']);
                    break;
                case 'choice':
                    $result[$key] = $this->choice($val['question'], $val['options']);
                    break;
                case 'secret':
                    $result[$key] = $this->secret($val['question']);
                    break;
                default:
                    $result[$key] = $this->ask($val['question']);
                    break;
            }
        }
        $this->_clear();
        $bar->advance();
        $this->output->writeln("\n");
        $config = $this->_buildConfig($result);
        if ($this->confirm('Would you like to view the DB config before writing the file? (note: your password will be visible in the console)', true)) {
            $this->comment($config);
        }
        $this->output->writeln('');
        $bar->finish();
    }
}
