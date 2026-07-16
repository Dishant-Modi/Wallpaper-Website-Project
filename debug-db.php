<?php
// redeploy-trigger
header('Content-Type: text/plain');

function mask($v) {
    if ($v === false || $v === null || $v === '') return '(not set)';
    return "(set, length " . strlen($v) . ")";
}

echo "DB_HOST: " . (getenv('DB_HOST') ?: '(not set)') . "\n";
echo "DB_PORT: " . (getenv('DB_PORT') ?: '(not set)') . "\n";
echo "DB_USER: " . (getenv('DB_USER') ?: '(not set)') . "\n";
echo "DB_PASS: " . mask(getenv('DB_PASS')) . "\n";
echo "DB_NAME: " . (getenv('DB_NAME') ?: '(not set)') . "\n";
echo "DB_SSL_CA: " . mask(getenv('DB_SSL_CA')) . "\n";
echo "---\n";

try {
    require_once __DIR__ . '/db.php';
    echo "DB Connection: SUCCESS\n";
    $result = $conn->query("SHOW TABLES");
    while ($row = $result->fetch_array()) {
        echo "Table: " . $row[0] . "\n";
    }
} catch (Throwable $e) {
    echo "DB Connection FAILED\n";
    echo get_class($e) . ": " . $e->getMessage() . "\n";
}
