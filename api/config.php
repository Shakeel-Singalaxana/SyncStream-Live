<?php
// api/config.php

define('ADMIN_PASSWORD', 'bcmu2025');
define('DATA_DIR', __DIR__ . '/../data/');

// Ensure data directory exists
if (!file_exists(DATA_DIR)) {
    mkdir(DATA_DIR, 0777, true);
}
?>
