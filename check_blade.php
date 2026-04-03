<?php
// Standalone script - place in Laravel root, run with: php check_blade.php

define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

// Boot the application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Get the blade compiler
$compiler = $app->make('blade.compiler');

$viewsPath = __DIR__ . '/resources/views';
$outputPath = __DIR__ . '/storage/framework/views';

// Compile app.blade.php directly
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));

foreach ($files as $file) {
    if (!$file->isFile()) continue;
    $path = $file->getPathname();
    if (!str_ends_with($path, '.blade.php')) continue;
    
    $relativePath = str_replace($viewsPath . '/', '', $path);
    
    try {
        // Read the source
        $source = file_get_contents($path);
        
        // Use reflection to call the protected compileString method
        $ref = new ReflectionMethod($compiler, 'compileString');
        $ref->setAccessible(true);
        $compiled = $ref->invoke($compiler, $source);
        
        // Check the compiled output for syntax errors
        $tmpFile = tempnam(sys_get_temp_dir(), 'blade_check_');
        file_put_contents($tmpFile, '<?php ob_start(); ?>' . "\n" . $compiled . "\n" . '<?php ob_end_clean(); ?>');
        
        $output = [];
        $return = 0;
        exec('php -l ' . escapeshellarg($tmpFile) . ' 2>&1', $output, $return);
        
        if ($return !== 0) {
            echo "SYNTAX ERROR in compiled: $relativePath\n";
            foreach ($output as $line) echo "  $line\n";
            
            // Show the compiled output around the error
            $lines = explode("\n", $compiled);
            echo "  Compiled output (last 20 lines):\n";
            $last = array_slice($lines, -20);
            foreach ($last as $i => $l) {
                echo "  " . (count($lines) - 20 + $i + 1) . ": $l\n";
            }
        } else {
            echo "OK: $relativePath\n";
        }
        
        unlink($tmpFile);
    } catch (Exception $e) {
        echo "COMPILE EXCEPTION in $relativePath: " . $e->getMessage() . "\n";
    }
}

echo "\nDone.\n";
