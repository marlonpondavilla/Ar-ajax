<?php
include_once '../database/dbh.php';

header('Content-Type: application/json');

try {
    $db = new Dbh();
    $pdo = $db->connect();

    $id = $_POST['id'] ?? null;
    $name = trim($_POST['name'] ?? '');

    if (!$id || !is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        exit;
    }

    if (empty($name)) {
        echo json_encode(['success' => false, 'message' => 'Name cannot be empty']);
        exit;
    }

    $sql = "UPDATE users SET fullName = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Record updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => $stmt->errorInfo()[2]]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
