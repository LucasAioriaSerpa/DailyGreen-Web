
<?php
// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Path to the JSON file
    $filePath = '/xampp/htdocs/DailyGreen-Project/JSON/login.json';

    // Write the data to the JSON file
    if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT))) {
        echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to write to file']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
