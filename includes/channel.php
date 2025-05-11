<?php
function add_channel() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO channels (name, stream_url) VALUES (?, ?)");
    $stmt->execute([$data["name"], $data["stream_url"]]);
    echo json_encode(["status" => "added"]);
}

function list_channels() {
    global $pdo;
    $res = $pdo->query("SELECT id, name, stream_url FROM channels");
    echo json_encode($res->fetchAll());
}
?>
