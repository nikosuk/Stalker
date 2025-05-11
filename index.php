<?php
require_once "includes/db.php";
require_once "includes/auth.php";
require_once "includes/channel.php";
require_once "includes/stream.php";
require_once "includes/category.php";
require_once "includes/import.php";
require_once "includes/logs.php";

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$method = $_SERVER["REQUEST_METHOD"];

if ($path == "/register" && $method == "POST") register_user();
elseif ($path == "/login" && $method == "POST") login_user();
elseif ($path == "/channels" && $method == "POST") add_channel();
elseif ($path == "/channels" && $method == "GET") list_channels();
elseif (preg_match("#^/play/(\d+)$#", $path, $m) && $method == "GET") proxy_stream($m[1]);
else http_response_code(404);
?>


elseif ($path == "/categories" && $method == "GET") list_categories();
elseif ($path == "/categories" && $method == "POST") add_category();
elseif ($path == "/import-m3u" && $method == "POST") import_m3u();

elseif ($path == "/logs" && $method == "GET") list_logs();
