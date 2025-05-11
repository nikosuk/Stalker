<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html><head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body><div class="container mt-5"><div class="card p-4 shadow-sm"><h3>Import M3U Playlist</h3>
<h3>Import M3U Playlist</h3>
<form class="d-flex gap-2" enctype="multipart/form-data" method="post" action="/import-m3u">
  <input type="file" name="playlist" accept=".m3u">
  <button class="btn btn-info" type="submit">Import</button>
</form>
</div></div></body></html>
