<?php
include_once '../database/dbh.php';

try {
    $db = new Dbh();
    $pdo = $db->connect();

    $stmt = $pdo->query("SELECT * FROM users");

    while ($row = $stmt->fetch()) {
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['fullName']);
        
        echo "<tr>
            <td class='border px-4 py-2'>{$id}</td>
            <td class='border px-4 py-2'>{$name}</td>
            <td class='border px-4 py-2'>
                <button onclick='updateRecord({$id}, \"{$name}\")' class='bg-yellow-400 px-2 py-1 rounded text-white'>Edit</button>
                <button onclick='deleteRecord({$id})' class='bg-red-500 px-2 py-1 rounded text-white ml-2'>Delete</button>
            </td>
        </tr>";
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo "<tr><td colspan='3' class='text-red-500 text-center'>Error fetching records</td></tr>";
}
?>
