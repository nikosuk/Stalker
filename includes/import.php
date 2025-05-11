<?php
function import_m3u() {
    global $pdo;
    if (!isset($_FILES["playlist"])) {
        http_response_code(400); echo "No file"; return;
    }
    $lines = file($_FILES["playlist"]["tmp_name"], FILE_IGNORE_NEW_LINES);
    $count = 0;
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], "#EXTINF") === 0 && isset($lines[$i+1])) {
            $meta = $lines[$i];
            $url = $lines[++$i];
            $name = "Channel " . $count;
            $cat = null;

            if (preg_match('/tvg-name="([^"]*)"/', $meta, $m)) $name = $m[1];
            if (preg_match('/group-title="([^"]*)"/', $meta, $m)) {
                $catName = $m[1];
                $pdo->prepare("INSERT IGNORE INTO categories (name) VALUES (?)")->execute([$catName]);
                $cat = $pdo->query("SELECT id FROM categories WHERE name = " . $pdo->quote($catName))->fetchColumn();
            }

            $stmt = $pdo->prepare("INSERT INTO channels (name, stream_url, category_id) VALUES (?, ?, ?)");
            $stmt->execute([$name, $url, $cat]);
            $count++;
        }
    }
    echo json_encode(["imported" => $count]);
}
?>
