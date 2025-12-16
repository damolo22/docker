<?php
// Configuración
$ignoreList = ['.', '..', 'index.php'];
$directories = scandir(__DIR__);
$projects = [];

// Escanear carpetas
foreach ($directories as $dir) {
    // Si es una carpeta y no está en la lista de ignorados
    if (!in_array($dir, $ignoreList) && is_dir(__DIR__ . '/' . $dir)) {
        
        // COMPROBACIÓN MÁGICA:
        // Si tiene carpeta 'public', el enlace apunta ahí. Si no, a la raíz.
        if (file_exists(__DIR__ . '/' . $dir . '/public')) {
            $link = $dir . '/public';
            $isLaravel = true;
        } else {
            $link = $dir;
            $isLaravel = false;
        }

        $projects[] = [
            'name' => $dir,
            'link' => $link,
            'isLaravel' => $isLaravel
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Proyectos Laravel</title>
    <style>
        :root { --bg: #1a1b26; --card: #24283b; --text: #c0caf5; --laravel: #f55247; }
        body { font-family: system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 40px; }
        
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; border-bottom: 1px solid #414868; padding-bottom: 20px; }
        h1 { margin: 0; font-weight: 300; color: var(--laravel); }
        .back-btn { text-decoration: none; color: var(--text); padding: 10px 20px; background: #414868; border-radius: 8px; font-size: 0.9em; }
        .back-btn:hover { background: #565f89; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        
        .card {
            background: var(--card); border-radius: 12px; padding: 25px; text-decoration: none; color: inherit;
            transition: transform 0.2s, border 0.2s; border: 1px solid transparent; display: flex; align-items: center; gap: 15px;
        }
        .card:hover { transform: translateY(-5px); border-color: var(--laravel); }
        
        .icon { font-size: 2em; }
        .details { display: flex; flex-direction: column; }
        .name { font-weight: bold; font-size: 1.1em; text-transform: capitalize; }
        .path { font-size: 0.8em; opacity: 0.6; margin-top: 4px; font-family: monospace; }
        .badge { font-size: 0.7em; background: #f5524733; color: #f55247; padding: 2px 8px; border-radius: 4px; width: fit-content; margin-top: 5px; }
    </style>
</head>
<body>

<div class="header">
    <h1>🔴 Zona Laravel</h1>
    <a href="../" class="back-btn">⬅ Volver al Inicio</a>
</div>

<div class="grid">
    <?php if (empty($projects)): ?>
        <p style="opacity: 0.5;">No hay proyectos aquí. Mueve tus carpetas de Laravel dentro.</p>
    <?php else: ?>
        <?php foreach ($projects as $proj): ?>
            <a href="<?php echo $proj['link']; ?>" class="card">
                <div class="icon">🚀</div>
                <div class="details">
                    <span class="name"><?php echo str_replace(['-', '_'], ' ', $proj['name']); ?></span>
                    <span class="path">/<?php echo $proj['name']; ?>/public</span>
                    <?php if($proj['isLaravel']): ?>
                        <span class="badge">Laravel Detectado</span>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>