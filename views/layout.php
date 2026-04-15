<!doctype html>
<?php $lang = function_exists('current_lang') ? current_lang() : 'es'; ?>
<html lang="<?= htmlspecialchars($lang) ?>" class="h-full scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php
    require_once __DIR__ . '/../app/seo.php';
    $seo = seo_build($seoData ?? []);
    echo seo_render_head($seo);
  ?>

  <meta name="color-scheme" content="light dark">

  <!-- Bootstrap: muchas vistas siguen usando row/col/card/list-unstyled/w-100/text-muted -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind config + CDN para utilidades modernas usadas en header/home/rutas -->
  <script>
    window.tailwind = window.tailwind || {};
    window.tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'system-ui', 'sans-serif']
          }
        }
      }
    };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- CSS propio -->
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="min-h-full bg-white text-zinc-800 dark:bg-zinc-950 dark:text-zinc-100 antialiased">
  <?php require __DIR__ . '/partials/header.php'; ?>
  <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <?= $__content ?? '' ?>
  </main>
  <?php require __DIR__ . '/partials/footer.php'; ?>

  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</body>
</html>
