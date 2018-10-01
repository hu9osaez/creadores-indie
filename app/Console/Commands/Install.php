<?php namespace CreadoresIndie\Console\Commands;

use Artisan;
use CreadoresIndie\Models\User;
use DB;
use Exception;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ci:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install or update Creadores Indie application.';

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
        try {
            DB::connection();
        } catch (Exception $e) {
            $this->error('Database connection not available');
            $this->error('Complete the data in the .env file and rerun this command.');

            return;
        }

        $this->line('*****');
        $this->info('Installing or updating Creadores Indie application');
        $this->line('');

        if (!config('app.key')) {
            $this->line('Generating APP_KEY');

            Artisan::call('key:generate');
        } else {
            $this->line('APP_KEY exists - Ignored');
        }

        $this->line('Migrating database tables');

        Artisan::call('migrate', ['--force' => true]);

        if (!User::count()) {
            $this->line('Creating initial data');

            Artisan::call('db:seed', ['--force' => true]);

            $this->line('');
            $this->info('Data for the administrator account');

            $name = $this->ask('What is your name?');
            $username = $this->ask('What is your username?');
            $email = $this->ask('What is your email address?');
            $password = $this->secret('Enter your password');

            $admin = new User();
            $admin->name = $name;
            $admin->username = $username;
            $admin->email = $email;
            $admin->password = $password;

            if($admin->save()) {
                $this->line('Account created successfully');
            }
            else {
                $this->error('Database connection not available');
            }
        } else {
            $this->comment('Existing initial data - Ignored');
        }

        $this->line('');
        $this->info('All the commands were executed successfully');
        $this->line('*****');
    }
}
