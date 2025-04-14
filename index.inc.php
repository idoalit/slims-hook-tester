<?php

/**
 * File: index.inc.php                                                         *
 * Project: hook-tester                                                        *
 * Created Date: Monday, April 14th 2025, 9:42:29 pm                           *
 * Author: Waris Agung Widodo <ido.alit@gmail.com>                             *
 * -----                                                                       *
 * Last Modified: Mon Apr 14 2025                                              *
 * Modified By: Waris Agung Widodo                                             *
 * -----                                                                       *
 * Copyright (c) 2025 Waris Agung Widodo                                       *
 * -----                                                                       *
 * HISTORY:                                                                    *
 * Date      	By	Comments                                                   *
 * ----------	---	---------------------------------------------------------  *
 */

class LogReader
{
    private $logFile;

    public function __construct($filePath)
    {
        $this->logFile = $filePath;

        // Cek apakah file ada dan bisa dibaca
        if (!file_exists($filePath)) {
            throw new Exception("File log tidak ditemukan: {$filePath}");
        }

        if (!is_readable($filePath)) {
            throw new Exception("File log tidak dapat dibaca: {$filePath}");
        }
    }

    /**
     * Membaca dan mengembalikan 500 baris terakhir dari file log
     *
     * @return string
     */
    public function getLines($max_lines = 500)
    {
        $lines = [];
        $file = new SplFileObject($this->logFile, 'r');
        $file->seek(PHP_INT_MAX); // Pindahkan pointer ke akhir file
        $totalLines = $file->key(); // Dapatkan jumlah total baris

        $startLine = max(0, $totalLines - $max_lines); // Tentukan baris mulai untuk 500 baris terakhir
        $file->seek($startLine); // Pindahkan pointer ke baris mulai

        while (!$file->eof()) {
            $lines[] = $file->fgets();
        }

        return htmlspecialchars(implode("", $lines)); // Gabungkan baris dan amankan output
    }
}

$config = require __DIR__ . '/config.inc.php';
$log_path = realpath($config['log_file']);

try {
    $logReader = new LogReader($log_path);

    $logContents = $logReader->getLines(500);
} catch (Exception $e) {
    $logContents = "Gagal menampilkan log: " . $e->getMessage();
}

?>

<div class="container mt-5">
    <h1 class="mb-4">Isi File Log</h1>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Log File: <?= $log_path ?>
        </div>
        <div class="card-body">
            <pre class="bg-light p-3" style="white-space: pre-wrap;"><?= $logContents; ?></pre>
        </div>
    </div>
</div>