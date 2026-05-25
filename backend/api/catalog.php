<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config.php';

// Check HTTP Method
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit();
}

$type = isset($_GET['type']) ? htmlspecialchars(strip_tags($_GET['type'])) : null;

// Valid types based on schema enum
$valid_types = ['vehicle', 'lodge', 'campsite', 'tent'];

try {
    if ($type && in_array($type, $valid_types)) {
        // Fetch specific type
        $query = "SELECT id, title, location, description, price_usd, image_url, features 
                  FROM catalog_items 
                  WHERE type = :type AND is_active = 1 
                  ORDER BY created_at DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':type', $type);
    } else {
        // Fetch all active items if no specific type is requested
        $query = "SELECT id, type, title, location, description, price_usd, image_url, features 
                  FROM catalog_items 
                  WHERE is_active = 1 
                  ORDER BY created_at DESC";
        $stmt = $pdo->prepare($query);
    }

    $stmt->execute();
    
    $num = $stmt->rowCount();

    if ($num > 0) {
        $items_arr = [];
        
        while ($row = $stmt->fetch()) {
            // Decode JSON features column back to array for API response
            $row['features'] = json_decode($row['features']);
            array_push($items_arr, $row);
        }

        http_response_code(200);
        echo json_encode(["status" => "success", "data" => $items_arr]);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "success", "data" => [], "message" => "No items found."]);
    }

} catch (PDOException $e) {
    error_log("Catalog Fetch Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Internal server error."]);
}
?>
