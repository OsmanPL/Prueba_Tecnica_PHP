FROM php:8.4-cli

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmariadb-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y nano

# Instalar las extensiones necesarias de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurar el directorio de trabajo
WORKDIR /var/www

COPY  . .

# Ejecutar composer install
RUN composer install

# Exponer el puerto 9000
EXPOSE 9000

# Comando para ejecutar PHP
CMD ["php", "-S", "0.0.0.0:9000", "-t", "/var/www"]
