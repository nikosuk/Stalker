<?php
function list_categories() {
    global $pdo;
    $res = $pdo->query("SELECT id, name FROM categories");
    echo json_encode($res->fetchAll());
}

function add_category() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$data["name"]]);
    echo json_encode(["status" => "category added"]);
}
?>
