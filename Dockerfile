FROM php:8.2-apache

# 1. Instalar dependencias del sistema
# HEMOS AÑADIDO: libicu-dev (para intl), libfreetype6-dev y libjpeg62-turbo-dev (para gd)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    mariadb-client \
    nano \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev

# 2. Configurar la extensión GD (Importante para imágenes en WordPress)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# 3. Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd mysqli zip soap intl

# 4. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Activar mod_rewrite de Apache
RUN a2enmod rewrite

# 6. Configurar el directorio de trabajo
WORKDIR /var/www/html

# 7. Cambiar permisos
RUN chown -R www-data:www-data /var/www/html

RUN echo '<Directory /var/www/html/>' >> /etc/apache2/apache2.conf && \
    echo '    Options Indexes FollowSymLinks' >> /etc/apache2/apache2.conf && \
    echo '    AllowOverride All' >> /etc/apache2/apache2.conf && \
    echo '    Require all granted' >> /etc/apache2/apache2.conf && \
    echo '</Directory>' >> /etc/apache2/apache2.conf