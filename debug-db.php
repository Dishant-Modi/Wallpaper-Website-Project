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

$ca = getenv('DB_SSL_CA');
if ($ca) {
    echo "DB_SSL_CA raw bytes (CA certs are public, safe to print):\n";
    echo "[" . $ca . "]\n";
    echo "Contains \\r: " . (strpos($ca, "\r") !== false ? 'YES' : 'no') . "\n";
    echo "Line count: " . (substr_count($ca, "\n") + 1) . "\n";
    echo "---\n";
}

try {
    require_once __DIR__ . '/db.php';
    echo "DB Connection: SUCCESS\n";
    $result = $conn->query("SHOW TABLES");
    while ($row = $result->fetch_array()) {
        echo "Table: " . $row[0] . "\n";
    }
} catch (Throwable $e) {
    echo "DB Connection FAILED\n";
    echo get_class($e) . ": " . $e->getMessage() . " (code " . $e->getCode() . ")\n";

    // Try again writing the CA to a real temp file -- mysqli_ssl_set's
    // documented contract expects file paths, not inline PEM content.
    if ($ca) {
        $tmpCa = tempnam(sys_get_temp_dir(), 'ca') . '.pem';
        file_put_contents($tmpCa, $ca);
        $conn2 = mysqli_init();
        mysqli_ssl_set($conn2, NULL, NULL, $tmpCa, NULL, NULL);
        try {
            $conn2->real_connect(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'), (int) getenv('DB_PORT'), NULL, MYSQLI_CLIENT_SSL);
            echo "File-path CA connection: SUCCESS\n";
        } catch (Throwable $e2) {
            echo "File-path CA connection FAILED\n";
            echo get_class($e2) . ": " . $e2->getMessage() . "\n";
        }
        unlink($tmpCa);
    }
}
