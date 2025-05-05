<?php
include_once '../database/dbh.php';

header('Content-Type: application/json');

try {
    $db = new Dbh();
    $pdo = $db->connect();

    $name = trim($_POST['name'] ?? '');

    if (!empty($name)) {
        // Use the consistent column name — assuming fullName
        $sql = "INSERT INTO users (fullName) VALUES (:name)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Record inserted successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->errorInfo()[2]]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Name is required.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
