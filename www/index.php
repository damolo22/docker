<?php
// Configuración
$ignoreList = ['.', '..', 'index.php', '.DS_Store', 'Thumbs.db'];
$directories = scandir(__DIR__);
$projects = [];

// Escanear carpetas
foreach ($directories as $dir) {
    if (!in_array($dir, $ignoreList) && is_dir(__DIR__ . '/' . $dir)) {
        $path = $dir;
        $label = "Proyecto Web";
        $icon = "🌐";
        
        // Detectar si es Laravel (tiene carpeta public y artisan)
        if (file_exists(__DIR__ . '/' . $dir . '/public') && file_exists(__DIR__ . '/' . $dir . '/artisan')) {
            $path = $dir . '/public'; // Laravel debe apuntar a public
            $label = "Laravel App";
            $icon = "🚀";
        }
        // Detectar si es WordPress (tiene wp-config o wp-content)
        elseif (file_exists(__DIR__ . '/' . $dir . '/wp-content')) {
            $label = "WordPress";
            $icon = "w";
        }

        $projects[] = [
            'name' => $dir,
            'path' => $path,
            'label' => $label,
            'icon' => $icon
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Servidor Docker</title>
    <style>
        :root { --bg: #1a1b26; --card: #24283b; --text: #c0caf5; --accent: #7aa2f7; }
        body { font-family: system-ui, -apple-system, sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 40px; }
        h1 { text-align: center; margin-bottom: 40px; font-weight: 300; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        /* Sección Herramientas */
        .tools { display: flex; justify-content: center; gap: 20px; margin-bottom: 50px; }
        .tool-btn {
            background: #414868; padding: 15px 30px; border-radius: 12px; text-decoration: none;
            color: white; font-weight: bold; transition: transform 0.2s, background 0.2s; display: flex; align-items: center; gap: 10px;
        }
        .tool-btn:hover { transform: translateY(-3px); background: var(--accent); }
        .tool-btn.db { background: #ff9e64; color: #1a1b26; }

        /* Grid de Proyectos */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .card {
            background: var(--card); border-radius: 15px; padding: 25px; text-decoration: none; color: inherit;
            transition: all 0.3s ease; border: 1px solid transparent; display: flex; flex-direction: column;
        }
        .card:hover { transform: translateY(-5px); border-color: var(--accent); box-shadow: 0 10px 20px rgba(0,0,0,0.3); }
        .card-icon { font-size: 2em; margin-bottom: 10px; }
        .card-title { font-size: 1.2em; font-weight: bold; margin: 0; color: var(--accent); text-transform: capitalize; }
        .card-type { font-size: 0.8em; opacity: 0.6; margin-top: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h1>🚀 Panel de Control - Localhost</h1>

    <div class="tools">
        <a href="http://localhost:8080" target="_blank" class="tool-btn db">
            🗄️ phpMyAdmin
        </a>
        </div>
    <div class="tools">
        <a href="http://localhost/wordpress/wp-admin" target="_blank" class="tool-btn db">
            🌐 WordPress Dashboard
        </a>
        </div>
    <h3 style="border-bottom: 1px solid #414868; padding-bottom: 10px;">Mis Proyectos</h3>
    <div class="grid">
        <?php if (empty($projects)): ?>
            <p style="grid-column: 1/-1; text-align: center; opacity: 0.5;">No hay proyectos. Crea una carpeta para empezar.</p>
        <?php else: ?>
            <?php foreach ($projects as $project): ?>
                <a href="<?php echo $project['path']; ?>" class="card">
                    <span class="card-icon"><?php echo $project['icon']; ?></span>
                    <span class="card-title"><?php echo str_replace(['-', '_'], ' ', $project['name']); ?></span>
                    <span class="card-type"><?php echo $project['label']; ?></span>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>