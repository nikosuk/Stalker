<?php
function list_logs() {
    global $pdo;
    $res = $pdo->query("SELECT l.id, l.channel_id, c.name AS channel_name, l.ip_address, l.accessed_at
                        FROM stream_logs l
                        JOIN channels c ON l.channel_id = c.id
                        ORDER BY l.accessed_at DESC");
    echo json_encode($res->fetchAll());
}
?>