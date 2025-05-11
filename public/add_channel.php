<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html><head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body><div class="container mt-5"><div class="card p-4 shadow-sm"><h3>Add Channel</h3>
<h3>Add Channel</h3>
<form onsubmit class="row gy-3"="event.preventDefault(); addChannel();">
  <div class="col-12"><label class="form-label">Name</label><input class="form-control" id="name"><br>
  <div class="col-12"><label class="form-label">Stream URL</label><input class="form-control" id="url"><br>
  <button class="btn btn-primary">Add</button>
</form>
<script>
async function addChannel() {
  const res = await fetch("/channels", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ name: name.value, stream_url: url.value })
  });
  const data = await res.json();
  alert(data.status);
}
</script>
</div></div></body></html>
