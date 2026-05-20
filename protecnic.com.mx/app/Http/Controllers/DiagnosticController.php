<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DiagnosticController extends Controller
{
    /**
     * Página de diagnóstico de uploads.
     * Sólo accesible en APP_ENV=local — protege contra exposición en producción.
     */
    public function uploads()
    {
        abort_unless(app()->environment('local'), 404);

        $tmpDir         = ini_get('upload_tmp_dir') ?: sys_get_temp_dir();
        $storagePublic  = storage_path('app/public');
        $publicStorage  = public_path('storage');

        // Intentar escribir un archivo de prueba en storage/app/public/_test
        $writeTest = ['ok' => false, 'error' => null];
        try {
            File::ensureDirectoryExists($storagePublic);
            $path = $storagePublic.DIRECTORY_SEPARATOR.'_writable_test.txt';
            File::put($path, 'ok '.now());
            $writeTest['ok'] = true;
            File::delete($path);
        } catch (\Throwable $e) {
            $writeTest['error'] = $e->getMessage();
        }

        // Intentar escribir en el tmp de PHP
        $tmpWriteTest = ['ok' => false, 'error' => null];
        try {
            $tmpFile = $tmpDir.DIRECTORY_SEPARATOR.'protecnic_tmp_test.txt';
            File::put($tmpFile, 'ok');
            $tmpWriteTest['ok'] = true;
            File::delete($tmpFile);
        } catch (\Throwable $e) {
            $tmpWriteTest['error'] = $e->getMessage();
        }

        $info = [
            'PHP version'             => PHP_VERSION,
            'php.ini cargado'         => php_ini_loaded_file() ?: '(no se detectó archivo)',
            'upload_max_filesize'     => ini_get('upload_max_filesize'),
            'post_max_size'           => ini_get('post_max_size'),
            'max_file_uploads'        => ini_get('max_file_uploads'),
            'memory_limit'            => ini_get('memory_limit'),
            'max_execution_time'      => ini_get('max_execution_time'),
            'file_uploads habilitado' => ini_get('file_uploads') ? 'Sí' : 'NO',
            'upload_tmp_dir'          => $tmpDir,
            '¿tmp existe?'            => is_dir($tmpDir) ? 'Sí' : 'NO',
            '¿tmp escribible?'        => $tmpWriteTest['ok'] ? 'Sí' : 'NO ('.$tmpWriteTest['error'].')',
            'fileinfo extension'      => extension_loaded('fileinfo') ? 'Cargado' : 'NO CARGADO',
            'gd extension'            => extension_loaded('gd') ? 'Cargado' : 'NO cargado',
            'storage/app/public'      => $storagePublic,
            '¿existe?'                => is_dir($storagePublic) ? 'Sí' : 'NO',
            '¿escribible?'            => $writeTest['ok'] ? 'Sí' : 'NO ('.$writeTest['error'].')',
            'public/storage (link)'   => $publicStorage,
            '¿existe symlink?'        => file_exists($publicStorage) ? 'Sí' : 'NO — corre `php artisan storage:link`',
            'APP_ENV'                 => app()->environment(),
        ];

        return view('diagnostic.uploads', compact('info'));
    }
}
