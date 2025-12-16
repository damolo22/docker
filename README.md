## 🛠️ Comandos Rápidos

### 🟢 1. Arrancar la máquina

Levanta el servidor y la base de datos en segundo plano.

```bash
docker-compose up -d
```
### 2. Entrar por SSH (Terminal)

Para ejecutar comandos dentro del servidor (como composer install, php artisan, etc.).

```bash
docker-compose exec app bash
```

> (Escribe exit para salir).

🔴 3. Apagar la máquina

Detiene los contenedores y libera la memoria RAM.

```bash
docker-compose down
```

# 🚀 Workflow de Sincronización: Clase <-> Casa

## ESCENARIO A: Al terminar la clase (GUARDAR)
**Objetivo:** Subir tus cambios de código y el estado actual de la base de datos a GitHub.

### 1. Exportar la Base de Datos
Git no guarda la base de datos "viva". Debemos congelarla en un archivo `.sql`.
*(Ejecuta esto en la terminal de VS Code)*:

```bash
docker exec servidor_mysql mysqldump -u root -proot --all-databases > backups/sync.sql
```

### 2. Subir todo a la nube

Subimos el código nuevo y el archivo SQL actualizado.

```bash
git add .
git commit -m "Sync: Avances de clase (BBDD actualizada)"
git push origin main
```

## ESCENARIO B: Al llegar a casa (CARGAR)

**Objetivo:** Bajar lo que hiciste en clase y restaurarlo en tu Docker local.

### 1. Bajar lo nuevo de la nube
Actualizamos los archivos del repositorio.

```bash
git pull origin main
```

### 2. Restaurar la Base de Datos

Inyectamos el archivo sync.sql (que acabamos de bajar) en el contenedor de base de datos.

```bash
Get-Content backups/sync.sql | docker exec -i servidor_mysql mysql -u root -proot
```

> [!WARNING]
> IMPORTANTE: Librerías nuevas (Composer)
Si en clase instalaste una librería nueva en Laravel (ej: para PDFs o imágenes), la carpeta vendor no se descarga sola. Si la web da error, reinstala las dependencias

## Cómo "Revivir" un proyecto Laravel (Al cambiar de PC)

Cuando te descargas el código de GitHub en un ordenador nuevo, al proyecto le faltan las librerías y la configuración. Si al entrar ves errores como `autoload.php not found` o `500 Server Error`, sigue este ritual.

**1. Entra en el contenedor y ve a la carpeta del proyecto:**

```bash
docker-compose exec app bash
cd laravel/NOMBRE_DE_TU_PROYECTO
```

**2. Instala las librerías:**

Descarga la carpeta `vendor` que Git no subió.

```bash
composer install
```

**3. Crea el archivo de configuración:**
Copia el ejemplo y genera la clave de seguridad.

```bash
cp .env.example .env
php artisan key:generate
```

**4. ⚠️ CONFIGURA LA BASE DE DATOS (VITAL):**
Abre el archivo `.env` nuevo en VS Code y cambia esto para que funcione en Docker:

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=nombre_db
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=file
```

**5. Migra y Limpia:**
Crea las tablas en la base de datos y refresca la caché.

```bash
php artisan config:clear
php artisan migrate
```

**6. Arregla los permisos:**
Si sale "Permission denied" en `storage`, ejecuta esto:

```bash
chown -R www-data:www-data .
chmod -R 775 storage bootstrap/cache
```