<?php

/**
 * Plugin Name: Hook tester
 * Plugin URI: #
 * Description: Simple plugin untuk mengecek apakah hook berjalan dengan baik
 * Version: 0.0.1
 * Author: Waris Agung Widodo
 * Author URI: https://github.com/idoalit
 */

use SLiMS\Plugins;

/**
 * Get plugin instance
 */
$plugin = Plugins::getInstance();
$config = require __DIR__ . '/config.inc.php';

foreach ($config['hooks'] as $hook) {
    $plugin->register($hook, function ($data) use ($config, $hook) {
        try {
            $logger = new Logger($config['log_file']);

            $logger->writeLog('DEBUG', $hook . ' data: ' . json_encode($data));
        } catch (Exception $e) {
            echo "Gagal membuat log: " . $e->getMessage();
        }
    });
}

$plugin->registerMenu('circulation', 'Test Hook Log', __DIR__ . '/index.inc.php');

class Logger
{
    private $logFile;

    public function __construct($filePath)
    {
        $this->logFile = $filePath;

        // Cek apakah file dapat ditulis atau tidak
        if (!is_writable($filePath) && !is_writable(dirname($filePath))) {
            throw new Exception("Log file tidak dapat ditulis: {$filePath}");
        }
    }

    /**
     * Menulis pesan log ke file
     *
     * @param string $level Tingkat log (contoh: INFO, ERROR, DEBUG)
     * @param string $message Pesan yang akan ditulis
     */
    public function writeLog($level, $message)
    {
        $timestamp = date('Y-m-d H:i:s'); // Format waktu log
        $logEntry = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;

        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}
