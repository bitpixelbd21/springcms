<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use BitPixel\SpringCms\Constants;
use Illuminate\Support\Facades\Config;

class InstallController
{
    public function index()
    {
        $this->createEnvFile();
        return view('river::admin.install.requirements');
    }

    public function checkRequirements(Request $request)
    {
        $requirements = [
            'PHP >= 8.0' => version_compare(PHP_VERSION, '8.0.0', '>='),
            'PDO Extension' => extension_loaded('pdo'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'Mbstring Extension' => extension_loaded('mbstring'),
            'Tokenizer Extension' => extension_loaded('tokenizer'),
            'JSON Extension' => extension_loaded('json'),
            'cURL Extension' => extension_loaded('curl'),
            'Zip Extension' => extension_loaded('zip'),
            'Writable Storage Directory' => is_writable(storage_path()),
        ];

        return response()->json($requirements);
    }

    public function database()
    {
        //set default DB params
        session([
            'db_host' => '127.0.0.1',
            'db_port' => '3306',
            'db_username' => 'root'
        ]);
        return view('river::admin.install.database');
    }

    public function saveDatabase(Request $request)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required',
            'db_database' => 'required',
            'db_username' => 'required',
            'db_password' => 'nullable',
        ]);

        // Update the .env file
        $this->updateEnv([
            'DB_HOST' => $request->input('db_host'),
            'DB_PORT' => $request->input('db_port'),
            'DB_DATABASE' => $request->input('db_database'),
            'DB_USERNAME' => $request->input('db_username'),
            'DB_PASSWORD' => $request->input('db_password'),
            'DB_CONNECTION' => 'mysql'
        ]);

        return redirect()->route('install.createAdmin');
    }

    public function testDatabaseConnection(Request $request)
    {
        // Get database parameters from the request
        $host = $request->input('db_host');
        $port = $request->input('db_port');
        $database = $request->input('db_database');
        $username = $request->input('db_username');
        $password = $request->input('db_password');
        // $create_database = $request->input('create_database');

        // if ($create_database) {
        //     $this->createDatabase($database);
        // }
        // Set a custom database connection configuration
        Config::set('database.connections.custom_test', [
            'driver' => 'mysql',
            'host' => $host,
            'port' => $port,
            'database' => $database,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);

        try {
            // Attempt to connect using the custom configuration
            DB::connection('custom_test')->getPdo();
            return response()->json(['success' => true, 'message' => 'Database connection successful']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function createAdmin()
    {
        return view('river::admin.install.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        session([
            'admin_name' => $request->name,
            'admin_email' => $request->email,
        ]);

        ini_set('max_execution_time', 300);  // 5 minutes
        ini_set('memory_limit', '512M');

        // dd('ss');
        Artisan::call('migrate:fresh', ["--force" => true]);
        Artisan::call('db:seed');

        $t = DB::table('river_admins')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_developer' => 1
        ]);

        $logged = Auth::guard(Constants::AUTH_GUARD_ADMINS)->attempt([ 'email' => $request->email, 'password' => $request->password ]);
        if($logged) {
            // Mark the application as installed
            Artisan::call('vendor:publish', ["--force" => true, '--tag' => 'springcms-assets']);
            Artisan::call('springcms:install');
            Artisan::call('springcms:cache-views');
            $this->markAsInstalled();
            return redirect()->route('river.admin.dashboard');
        }

        return back()->withErrors(['Failed to install'])->withInput();

    }

    private function updateEnv($data = [])
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {

            // Check if the key already exists
            if (preg_match('/^' . preg_quote($key, '/') . '=/m', $envContent)) {
                // If it exists, update the value
                $envContent = preg_replace('/^' . preg_quote($key, '/') . '=.*/m', $key . '=' . $value, $envContent);
            } else {
                // If it doesn't exist, add the key-value pair to the end of the file
                $envContent .= PHP_EOL . $key . '=' . $value;
            }
            // $pattern = "/^{$key}=.*$/m";
            // $replacement = "{$key}={$value}";
            // $envContent = preg_replace($pattern, $replacement, $envContent);
        }

        File::put($envPath, $envContent);
    }

    private function createDatabase($dbName)
    {
        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`;");
        } catch (\Exception $e) {
            // Handle error
            // dd($e);
        }
    }
   
    private function createEnvFile()
    {
        // Check if the .env file exists, if not, copy .env.example to .env
        if (!file_exists(base_path('.env'))) {
            if (file_exists(base_path('.env.example'))) {
                copy(base_path('.env.example'), base_path('.env'));
            }
        }
    }

    private function markAsInstalled()
    {
        // Update .env file
        $this->updateEnv(['APP_INSTALLED' => 'true']);

        // Clear the session data
        session()->forget(['db_host', 'db_port', 'db_database', 'db_username', 'db_password', 'create_database', 'admin_name', 'admin_email']);
    }
}
