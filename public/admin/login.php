<?php
require __DIR__ . '/../../app/bootstrap.php'; // aquí cargará auth.php
start_session_once();

// Si ya está logueado, manda directo al panel
if (is_admin_logged()) {
  header('Location: /admin/zones.php');
  exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['username'] ?? '');
  $pass = trim($_POST['password'] ?? '');

  // Carga usuario
  $st = db()->prepare("SELECT id,username,password_hash,role,active FROM users WHERE username=:u LIMIT 1");
  $st->execute([':u' => $user]);
  $row = $st->fetch(PDO::FETCH_ASSOC);

  if ($row && (int)$row['active'] === 1 && password_verify($pass, $row['password_hash'])) {
    admin_login($row);
    header('Location: /admin/zones.php');
    exit;
  }

  $error = 'Usuario o contraseña incorrectos.';
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login admin</title>
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,'Helvetica Neue',Arial,'Noto Sans',sans-serif;background:#f5f7fb;margin:0;display:flex;min-height:100vh;align-items:center;justify-content:center}
    form{background:#fff;padding:24px 28px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,.08);width:360px}
    h2{margin:0 0 12px;font-size:20px}
    .muted{color:#6b7280;font-size:12px;margin:0 0 18px}
    input{width:100%;padding:10px 12px;margin:8px 0;border:1px solid #e5e7eb;border-radius:10px;font-size:14px}
    button{width:100%;border:0;background:#0b1220;color:#fff;padding:10px 12px;border-radius:10px;font-weight:600;cursor:pointer}
    .error{color:#d00;background:#fee;border:1px solid #fbb;padding:8px 10px;border-radius:8px;font-size:13px;margin-bottom:8px}
  </style>
</head>
<body>
  <form method="post" autocomplete="off">
    <h2>Panel administrador</h2>
    <p class="muted">Inicia sesión para gestionar zonas y precios.</p>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <input type="text" name="username" placeholder="Usuario" required autofocus>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Entrar</button>
  </form>
</body>
</html>
