<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html><head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body><nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container"><a class="navbar-brand" href="#">IPTV Admin</a><div><a class="btn btn-outline-light" href="logout.php">Logout</a></div></div></nav><div class="container mt-4">
<h2>Admin Panel</h2><p><a href='logout.php'>Logout</a></p>
<p><a class="btn btn-success me-2" href="add_channel.php">Add Channel</a></p>
<p><a class="btn btn-info me-2" href="import.php">Import M3U</a></p>
<p><a class="btn btn-secondary me-2" href="../channels">View Channels JSON</a></p>
<p><a class="btn btn-secondary me-2" href="logs.php">View Logs</a><a class="btn btn-secondary" href="../categories">View Categories JSON</a></p>
</div></body></html>
