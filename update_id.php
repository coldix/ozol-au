<?php
require_once 'includes/load-yourls.php';
$current_id = yourls_get_option('next_id');
echo "Current next_id: " . $current_id . "\n";
yourls_update_option('next_id', 46656);
echo "Updated next_id to 46656. The next base36 short url will be 1000.\n";
