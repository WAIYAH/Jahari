<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../config.php';

// Check HTTP Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit();
}

// Get posted raw JSON data
$data = json_decode(file_get_contents("php://input"));

// Basic validation
if (
    !empty($data->client_name) &&
    !empty($data->client_phone) &&
    !empty($data->subject)
) {
    // Sanitize input to prevent XSS
    $client_name = htmlspecialchars(strip_tags($data->client_name));
    $client_phone = htmlspecialchars(strip_tags($data->client_phone));
    $client_email = !empty($data->client_email) ? htmlspecialchars(strip_tags($data->client_email)) : null;
    $subject = htmlspecialchars(strip_tags($data->subject));
    $start_date = !empty($data->start_date) ? htmlspecialchars(strip_tags($data->start_date)) : null;
    $end_date = !empty($data->end_date) ? htmlspecialchars(strip_tags($data->end_date)) : null;

    try {
        // Prepare SQL with PDO to prevent SQL Injection
        $query = "INSERT INTO inquiries (client_name, client_phone, client_email, subject, start_date, end_date) 
                  VALUES (:client_name, :client_phone, :client_email, :subject, :start_date, :end_date)";
        
        $stmt = $pdo->prepare($query);

        // Bind parameters
        $stmt->bindParam(':client_name', $client_name);
        $stmt->bindParam(':client_phone', $client_phone);
        $stmt->bindParam(':client_email', $client_email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);

        // Execute query
        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Inquiry successfully recorded."]);
        } else {
            http_response_code(503);
            echo json_encode(["status" => "error", "message" => "Unable to record inquiry."]);
        }
    } catch (PDOException $e) {
        error_log("Inquiry Insert Error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Internal server error."]);
    }

} else {
    // Incomplete data
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Incomplete data. Name, phone, and subject are required."]);
}
?>
