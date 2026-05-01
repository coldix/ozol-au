<?php
header('Content-Type: application/json');

// Initialize YOURLS environment
require_once dirname(__FILE__) . '/includes/load-yourls.php';

// Ensure short URLs are at least 4 characters long (base36 minimum for 4 chars is 46656)
$current_next_id = yourls_get_option('next_id');
if ($current_next_id !== false && (int)$current_next_id < 46656) {
    yourls_update_option('next_id', 46656);
}

// Check if URL was posted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['url'])) {
    
    // Verify frontend password
    $provided_password = isset($_POST['password']) ? $_POST['password'] : '';
    if (!defined('FRONTEND_PASSWORD') || $provided_password !== FRONTEND_PASSWORD) {
        echo json_encode([
            'status'  => 'fail',
            'message' => 'Unauthorized: Incorrect password'
        ]);
        exit;
    }

    $url = $_POST['url'];
    // Keyword is optional
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    
    // Use YOURLS internal function to shorten
    $result = yourls_add_new_link($url, $keyword);
    
    echo json_encode($result);
} else {
    echo json_encode([
        'status'  => 'fail',
        'message' => 'Please provide a valid URL'
    ]);
}
