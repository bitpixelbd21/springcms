<?php

namespace BitPixel\SpringCms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use BitPixel\SpringCms\Models\TemplatePage;

class DatabaseSeederCommand extends Command
{
    public $signature = 'springcms:install';

    public $description = 'Create an admin user & all the basic templates';


    public function handle()
    {
        // $this->createAdminUsers();

        $this->seedTemplateFiles();

        $this->info('Done!');
    }

    private function createAdminUsers()
    {
        // Ask for the email
        $email = $this->ask('Enter admin email address');

        // Validate the email
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:river_admins,email',
        ]);

        if ($validator->fails()) {
            $this->error('The email address is invalid or already exists.');
            return 1;
        }

        // Ask for the password
        $password = $this->secret('Enter the password(must be at least 8 characters long)');

        // Validate the password (optional)
        $passwordValidator = Validator::make(['password' => $password], [
            'password' => 'required|min:8',
        ]);

        if ($passwordValidator->fails()) {
            $this->error('The password must be at least 8 characters long.');
            return 1;
        }

        // Confirm password (optional)
        $passwordConfirmation = $this->secret('Confirm the password');

        if ($password !== $passwordConfirmation) {
            $this->error('Passwords do not match.');
            return 1;
        }

        // Create the user
        DB::table('river_admins')->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email'=> $email,
            'password' => Hash::make($password),
            'is_developer' => 1
        ]);

        // Provide feedback to the user
        $this->info('Admin user created successfully');

        return 0;
    }

    private function seedTemplateFiles()
    {
        $path    = __DIR__ . '/templates';
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file) {
            $content = file_get_contents($path . '/' . $file);
            TemplatePage::create([
                'filename' => $file,
                'code' => $content
            ]);
        }
    }

}
