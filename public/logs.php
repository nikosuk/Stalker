<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
?><!DOCTYPE html>
<html><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"><div class="container">
<a class="navbar-brand" href="admin.php">IPTV Admin</a>
</div></nav>
<div class="container mt-4">
<h3>Stream Access Logs</h3>
<table class="table table-striped">
<thead><tr><th>ID</th><th>Channel</th><th>IP Address</th><th>When</th></tr></thead><tbody id="log-body"></tbody>
</table>
</div>
<script>
fetch("/logs", { credentials: "include" })
  .then(res => res.json())
  .then(data => {
    const body = document.getElementById("log-body");
    data.forEach(row => {
      const tr = document.createElement("tr");
      tr.innerHTML = `<td>${row.id}</td><td>${row.channel_name}</td><td>${row.ip_address}</td><td>${row.accessed_at}</td>`;
      body.appendChild(tr);
    });
  });
</script>
</body></html>
