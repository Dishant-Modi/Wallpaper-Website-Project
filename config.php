<?php
    // Now a thin wrapper -- real connection logic lives in db.php, shared
    // with contact.php and payme.php (all three originally pointed at
    // separate local databases; consolidated into one for deployment).
    require __DIR__ . '/db.php';
?>
