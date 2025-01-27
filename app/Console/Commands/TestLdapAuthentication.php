<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;


class TestLdapAuthentication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ldap:auth {username} {password}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');
        $password = $this->argument('password');

        try {
            // Attempt authentication
            $credentials = [
                'samaccountname' => $username,
                'password' => $password,
            ];

            if (Auth::attempt($credentials)) {
                $this->info('Authenticated successfully!');
            } else {
                $this->error('Invalid credentials.');
            }
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }

        return 0;
    }
}
