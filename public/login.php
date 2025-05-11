<!DOCTYPE html>
<html><head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head><body class="bg-light"><div class="container"><div class="row justify-content-center"><div class="col-md-6">
<h2>Login</h2>
<form class="card p-4 mt-5 shadow-sm" method="post" action="/login" onsubmit="event.preventDefault(); fetchLogin();">
  <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" id="user"></div>
  <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" type="password" name="password" id="pass"></div>
  <button class="btn btn-primary w-100" type="submit">Login</button>
</form>
<script>
async function fetchLogin() {
  const res = await fetch("/login", {
    credentials: "include",
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username: user.value, password: pass.value })
  });
  const data = await res.json();
  if (data.user_id) {
    localStorage.setItem("user_id", data.user_id);
    document.cookie = "PHPSESSID=" + document.cookie.match(/PHPSESSID=([^;]+)/)[1]; location.href = "/public/admin.php";
  } else alert("Login failed");
}
</script>
</div></div></div></body></html>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = json_decode(file_get_contents("php://input"), true);
  require_once "../includes/db.php";
  $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
  $stmt->execute([$data["username"]]);
  $user = $stmt->fetch();
  if (!$user || !password_verify($data["password"], $user["password"])) {
      http_response_code(401); echo "Invalid"; return;
  }
  $_SESSION["user_id"] = $user["id"];
  echo json_encode(["status" => "ok", "user_id" => $user["id"]]);
  exit;
}
?>
