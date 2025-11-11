<?php
require __DIR__.'/../../app/bootstrap.php';
require_admin();
session_start();

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $user = trim($_POST['username'] ?? '');
  $pass = trim($_POST['password'] ?? '');

  $st = db()->prepare("SELECT * FROM users WHERE username=:u AND active=1");
  $st->execute([':u'=>$user]);
  $row = $st->fetch(PDO::FETCH_ASSOC);

  if ($row && hash_equals($row['password_hash'], hash('sha256',$pass))) {
    $_SESSION['admin'] = [
      'id' => $row['id'],
      'username' => $row['username'],
      'role' => $row['role']
    ];
    header('Location: /admin/zones.php'); exit;
  }

  $error = "Usuario o contraseña incorrectos.";
}
?>
<!doctype html><html><head>
  <meta charset="utf-8"><title>Login admin</title>
  <style>
    body{font-family:sans-serif;display:flex;align-items:center;justify-content:center;height:100vh;background:#f5f5f5}
    form{background:white;padding:2rem;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,.1)}
    input{display:block;width:100%;margin-bottom:1rem;padding:.5rem}
    button{background:#0b1220;color:white;border:0;padding:.5rem 1rem;border-radius:6px}
  </style>
</head><body>
  <form method="post">
    <h2>Panel administrador</h2>
    <?php if(!empty($error)): ?><p style="color:red;"><?=htmlspecialchars($error)?></p><?php endif; ?>
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
  </form>
</body></html>
