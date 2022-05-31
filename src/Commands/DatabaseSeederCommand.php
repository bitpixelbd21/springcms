<?php

namespace Rashidul\River\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeederCommand extends Command
{
    public $signature = 'river:seed';

    public $description = 'Seed database';


    public function handle()
    {
        $this->seedAdminUsers();

        $this->info('Done!');
    }

    private function seedAdminUsers()
    {
        //TODO check if data alreadu exists in db
        DB::table('river_admins')->insert([
//            'role_id' => 1,
            'name' => 'Admin',
            'email'=>'admin@gmail.com',
            'password' => Hash::make('1234')
        ]);
    }

}
