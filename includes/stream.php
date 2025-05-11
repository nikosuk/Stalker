<?php
function proxy_stream($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT stream_url FROM channels WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row) { http_response_code(404); return; }
// Log access
$log = $pdo->prepare("INSERT INTO stream_logs (channel_id, ip_address) VALUES (?, ?)");
$log->execute([$id, $_SERVER['REMOTE_ADDR']]);

    header("Content-Type: video/mp2t");
    readfile($row["stream_url"]);
}
?>
