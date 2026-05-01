<?php
header('Content-Type: application/json');

// Initialize YOURLS environment
require_once dirname(__FILE__) . '/includes/load-yourls.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['url'])) {
    $url = $_POST['url'];
    $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
    
    if ($keyword !== '') {
        $keyword = strtolower($keyword);
        // Valid custom keyword check
        if (!preg_match('/^[a-z0-9]+$/', $keyword)) {
            echo json_encode([
                'status'  => 'fail',
                'message' => 'Custom keyword can only contain letters and numbers. No spaces or punctuation allowed.'
            ]);
            exit;
        }
        $len = strlen($keyword);
        if ($len < 3 || $len > 20) {
            echo json_encode([
                'status'  => 'fail',
                'message' => 'Custom keyword should be between 3 and 20 characters long.'
            ]);
            exit;
        }
    } else {
        // Generate random 3-char keyword
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $found = false;
        $max_attempts = 20;
        for ($i = 0; $i < $max_attempts; $i++) {
            $random_kw = '';
            for ($j = 0; $j < 3; $j++) {
                $random_kw .= $chars[mt_rand(0, strlen($chars) - 1)];
            }
            if (!yourls_keyword_is_taken($random_kw)) {
                $keyword = $random_kw;
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo json_encode([
                'status'  => 'fail',
                'message' => 'Could not generate a unique short link. Please try a custom keyword.'
            ]);
            exit;
        }
    }
    
    // Use YOURLS internal function to shorten
    $result = yourls_add_new_link($url, $keyword);
    
    echo json_encode($result);
} else {
    echo json_encode([
        'status'  => 'fail',
        'message' => 'Please provide a valid URL'
    ]);
}
