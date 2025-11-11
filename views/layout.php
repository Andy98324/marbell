<!doctype html>
<html lang="es" class="h-full scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Tailwind (CDN, solo para desarrollo o validación visual) -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Si quieres una fuente bonita -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Tu CSS opcional -->
<link rel="stylesheet" href="/assets/css/app.css">


  <?php
    require_once __DIR__ . '/../app/seo.php';
    // $seoData puede venir de la ruta; aquí ponemos defaults si no existe
    $seo = seo_build($seoData ?? []);
    echo seo_render_head($seo);
  ?>

  <!-- Tailwind CDN (dev) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' }
  </script>
  <!-- Alpine.js -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <meta name="color-scheme" content="light dark">
</head>
<body class="min-h-full bg-white text-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 antialiased">
  <?php require __DIR__ . '/partials/header.php'; ?>
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <?= $__content ?? '' ?>
  </main>
  <?php require __DIR__ . '/partials/footer.php'; ?>
  

</body>
</html>
