<?php
// views/quote.php
// Este archivo muestra los resultados del cálculo de cotización
// y utiliza exclusivamente precios de zona definidos en la BD.

if (!isset($quotes)) $quotes = [];

// Helper seguro para mostrar precios en euros
function eur($v): string {
  return '€' . number_format((float)$v, 2, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nuestra flota</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-zinc-900 text-white min-h-screen">
  <main class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-extrabold text-center mb-10">Nuestra flota</h1>

    <div class="text-center mb-6">
      <p><strong>Origen:</strong> <?= htmlspecialchars($origin_address ?? $oAddr ?? '') ?></p>
      <p><strong>Destino:</strong> <?= htmlspecialchars($destination_address ?? $dAddr ?? '') ?></p>
      <p class="mt-2 text-zinc-400">Distancia: <?= number_format((float)$km, 1, ',', '.') ?> km · Duración estimada: <?= round((float)$minutes) ?> min</p>
    </div>

    <?php if (empty($quotes)): ?>
      <div class="text-center text-red-400 font-semibold">No se encontraron vehículos disponibles.</div>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($quotes as $q): ?>
          <?php
            $hasPrice = isset($q['price']) && $q['price'] !== null && $q['price'] !== '';
            $priceText = $hasPrice ? eur($q['price']) : 'No disponible';
            $badgeText = $hasPrice ? 'Tarifa fija por zona' : 'Sin tarifa definida';
          ?>
          <article class="group bg-white text-zinc-900 rounded-2xl shadow-lg p-5 flex flex-col justify-between">
            <div>
              <?php if (!empty($q['img'])): ?>
                <img src="<?= htmlspecialchars($q['img']) ?>" alt="<?= htmlspecialchars($q['name']) ?>" class="mx-auto h-32 object-contain mb-3">
              <?php endif; ?>

              <h3 class="text-lg font-bold text-center"><?= htmlspecialchars($q['name']) ?></h3>
              <p class="text-sm text-center text-zinc-600"><?= htmlspecialchars($q['capacity'] ?? '') ?></p>

              <div class="mt-4 text-center">
                <?php if ($hasPrice): ?>
                  <div class="text-3xl font-extrabold text-zinc-900"><?= $priceText ?></div>
                  <div class="text-green-600 text-sm mt-1"><?= htmlspecialchars($badgeText) ?></div>
                <?php else: ?>
                  <div class="text-2xl font-bold text-zinc-400"><?= $priceText ?></div>
                  <div class="text-amber-600 text-sm mt-1"><?= htmlspecialchars($badgeText) ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="mt-5 text-center">
              <button
                class="w-full py-3 rounded-xl font-semibold transition <?= $hasPrice ? 'bg-amber-400 text-zinc-900 hover:bg-amber-300' : 'bg-zinc-200 text-zinc-500 cursor-not-allowed' ?>"
                <?= $hasPrice ? '' : 'disabled' ?>
                type="button">
                <?= function_exists('t') ? t('home.select') : 'Seleccionar vehículo' ?>
              </button>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <p class="text-center text-zinc-400 mt-10 text-sm">
      <?= function_exists('t') ? t('home.quote_disclaimer') : 'El precio mostrado es orientativo y puede variar según disponibilidad.' ?>
    </p>
  </main>
</body>
</html>
