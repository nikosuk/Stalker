<?php
function register_user() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$data["username"]]);
    if ($stmt->fetch()) {
        http_response_code(409); echo "User exists"; return;
    }
    $hash = password_hash($data["password"], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password, is_admin) VALUES (?, ?, 0)");
    $stmt->execute([$data["username"], $hash]);
    echo json_encode(["status" => "registered"]);
}

function login_user() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$data["username"]]);
    $user = $stmt->fetch();
    if (!$user || !password_verify($data["password"], $user["password"])) {
        http_response_code(401); echo "Invalid"; return;
    }
    echo json_encode(["status" => "ok", "user_id" => $user["id"]]);
}
?>
function require_admin($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    if (!$stmt->fetchColumn()) {
        http_response_code(403); echo "Admin only"; exit;
    }
}