<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Models\User;

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
            'Writable Storage Directory' => is_writable(storage_path()),
        ];

        return response()->json($requirements);
    }

    public function database()
    {
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
            'DB_HOST' => $request->db_host,
            'DB_PORT' => $request->db_port,
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password,
        ]);

        Artisan::call('key:generate');

        // If create_database is checked
        if ($request->create_database) {
            $this->createDatabase($request->db_database);
        }

        session([
            'db_host' => $request->db_host,
            'db_port' => $request->db_port,
            'db_database' => $request->db_database,
            'db_username' => $request->db_username,
            'db_password' => $request->db_password,
            'create_database' => $request->create_database,
        ]);

        return redirect()->route('install.createAdmin');
    }

    public function testDatabaseConnection(Request $request)
    {
        try {
            $connection = DB::connection()->getPdo();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        session([
            'admin_name' => $request->name,
            'admin_email' => $request->email,
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        // Run migrations and seeders
        Artisan::call('migrate', ['--force' => true]);
        // Mark the application as installed
        $this->markAsInstalled();
        return redirect()->route('home');
    }

    private function updateEnv($data = [])
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*$/m";
            $replacement = "{$key}={$value}";
            $envContent = preg_replace($pattern, $replacement, $envContent);
        }

        File::put($envPath, $envContent);
    }

    private function createDatabase($dbName)
    {
        try {
            DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName`;");
        } catch (\Exception $e) {
            // Handle error
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
