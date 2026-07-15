<?php
    // Shared DB connection for the whole site. The original project used
    // three separate local databases (login/contactform/paymentdb); they're
    // consolidated into one here since most hosts only offer a single free
    // database instance. Sets both $conn (used by the procedural
    // mysqli_prepare() calls in login.php/register.php) and $mysqli (used by
    // the object-oriented ->prepare() calls elsewhere) to the same connection.

    $db_host = 'localhost';
    $db_port = 3306;
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'wallpaper_site';
    $db_ssl_ca = null;

    if (getenv('DB_HOST')) $db_host = getenv('DB_HOST');
    if (getenv('DB_PORT')) $db_port = (int) getenv('DB_PORT');
    if (getenv('DB_USER')) $db_user = getenv('DB_USER');
    if (getenv('DB_PASS')) $db_pass = getenv('DB_PASS');
    if (getenv('DB_NAME')) $db_name = getenv('DB_NAME');
    if (getenv('DB_SSL_CA')) $db_ssl_ca = getenv('DB_SSL_CA');

    // config.local.php is gitignored -- kept for shared-hosting-style
    // deployments that don't expose environment variables.
    if (file_exists(__DIR__ . '/config.local.php')) {
        require __DIR__ . '/config.local.php';
    }

    if ($db_ssl_ca) {
        $conn = mysqli_init();
        mysqli_ssl_set($conn, NULL, NULL, $db_ssl_ca, NULL, NULL);
        $conn->real_connect($db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL);
    } else {
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $mysqli = $conn;
?>
