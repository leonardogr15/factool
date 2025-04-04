# Usar la imagen de PHP 8.0 FPM
FROM php:8.0-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo en /var/www
WORKDIR /var/www

# Copiar el contenido de tu proyecto en el contenedor
COPY . .

# Ejecutar composer install
RUN composer install

# Exponer el puerto
EXPOSE 9000
