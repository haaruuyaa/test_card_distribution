<?php

require_once __DIR__ . '/src/CardDistributor.php';

// Add CORS headers
header("Access-Control-Allow-Origin: *"); // Allow all origins (you can restrict this later)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allowed HTTP methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header('Content-Type: application/json');

// Handle preflight requests (OPTIONS method)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0); // Respond with a 200 status for preflight requests
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['people'])) {
        echo CardDistributor::distribute($data['people']);
    } else {
        echo json_encode(["error" => "Input value does not exist or value is invalid"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}