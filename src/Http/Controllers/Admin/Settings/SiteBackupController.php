<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Ifsnop\Mysqldump\Mysqldump;
use BitPixel\SpringCms\Services\SettingsService;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SiteBackupController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];

        return view('river::admin.settings.site_backup.index', $data);

    }

    public function restore(Request $request)
    {
        // Validate the request
        $request->validate([
            'backup_file' => 'required|file|mimes:zip'
        ]);

        // Get the uploaded file
        $file = $request->file('backup_file');

        // Extract the zip file
        $zipArchive = new ZipArchive();
        $zipArchive->open($file->getPathname());

        // Find and extract the SQL file
        $sqlFileName = 'database.sql';
        $sqlFilePath = $sqlFileName;
        $zipArchive->extractTo(storage_path('app/public/'), $sqlFileName);
        $zipArchive->close();

        // Import the SQL file

        //first empty few tables to avoid duplicate entries
        DB::unprepared("
        SET FOREIGN_KEY_CHECKS = 0;

        TRUNCATE TABLE `river_banners`;
        TRUNCATE TABLE `river_blog`;
        TRUNCATE TABLE `river_blog_category`;
        TRUNCATE TABLE `river_blog_tag`;
        TRUNCATE TABLE `river_contactform_submissions`;
        TRUNCATE TABLE `river_customers`;
        TRUNCATE TABLE `river_data_entries`;`
        TRUNCATE TABLE `river_data_fields`;
        TRUNCATE TABLE `river_faq`;
        TRUNCATE TABLE `river_field_values`;
        TRUNCATE TABLE `river_newsletter_submissions`;
        TRUNCATE TABLE `river_pages`;
        TRUNCATE TABLE `river_roles`;
        TRUNCATE TABLE `river_role_permission`;
        TRUNCATE TABLE `river_service`;
        TRUNCATE TABLE `river_service_category`;
        TRUNCATE TABLE `river_settings`;
        TRUNCATE TABLE `river_sliders`;
        TRUNCATE TABLE `river_tag`;
        TRUNCATE TABLE `river_menu_item`;
        TRUNCATE TABLE `river_menu`;
        TRUNCATE TABLE `river_template_assets`;
        TRUNCATE TABLE `river_template_pages`;
        TRUNCATE TABLE `river_template_pages_versions`;
        TRUNCATE TABLE `river_testimonial`;

        SET FOREIGN_KEY_CHECKS = 1;
        ");


        DB::unprepared(file_get_contents(storage_path('app/public/' . $sqlFilePath)));

        // Extract the folder
        $zipArchive->open($file->getPathname());
        $zipArchive->extractTo(public_path(), '/');
        $zipArchive->close();

        // Delete the SQL and zip files
        File::delete(storage_path('app/public/' . $sqlFilePath));
        File::delete(storage_path('app/public/' . basename($file->getPathname())));

        return response()->json(['message' => 'Backup restored successfully']);
    }

    public function backup_store(){
        // Get database credentials from the .env file
        $dbHost = config('database.connections.mysql.host');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $currentDate = Carbon::now()->format('d-m-Y');

        // Create a temporary directory for storing backup files
        $tempDir = storage_path('app/temp_backup');
        File::makeDirectory($tempDir, 0755, true, true);

        // Dump the database to an SQL file using mysqldump-php
        $sqlFilePath = $tempDir . '/database2.sql';
        $dump = new Mysqldump("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass, [
            'if-not-exists' => true,
            'exclude-tables' => ['migrations', 'cache', 'cache_locks', 'failed_jobs', 'password_reset_tokens', 
            'sessions', 'jobs', 'job_batches', 'users', 'river_admins'], //excluding river admins table since it may conflict with the existing admin table
        ]);
        $dump->start($sqlFilePath);



        // Create a zip file
        $zip = new ZipArchive;
        $zipFileName = $currentDate . '.zip';

        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            // Add the SQL file to the zip
            $zip->addFile($sqlFilePath, 'database.sql');

            $publicDirectory = public_path('uploads');
            $this->addFilesToZip($publicDirectory, $zip, 'uploads');


            $zip->close();

            // Delete the temporary directory after creating the zip
            File::deleteDirectory($tempDir);

            // Download the zip file
            return response()->download($zipFilePath)->deleteFileAfterSend();
        } else {
            return 'Unable to create the zip file.';
        }
    }

    private function addFilesToZip($dir, $zip, $relativePath = '')
    {
        $files = File::allFiles($dir);

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativeFilePath = $relativePath . '/' . $file->getRelativePathname();

            $zip->addFile($filePath, $relativeFilePath);
        }
    }

}
