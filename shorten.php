<?php
header('Content-Type: application/json');

// Initialize YOURLS environment
require_once dirname(__FILE__) . '/includes/load-yourls.php';

// Check if URL was posted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['url'])) {
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
