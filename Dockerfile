FROM php:8.3.11-apache

# Instalar dependencias y Composer
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpng-dev libjpeg62-turbo-dev libfreetype6-dev
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version  # Verifica que Composer esté instalado

# Copiar archivos
COPY . /var/www/html
COPY ./public/.htaccess /var/www/html/.htaccess

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalación de dependencias con Composer
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Asegurarse de que las variables de entorno estén configuradas
ENV APP_KEY=somekey
ENV DB_CONNECTION=mysql
ENV DB_HOST=35.184.121.46
ENV DB_PORT=3306
ENV DB_DATABASE=laravelproyect
ENV DB_USERNAME=root
ENV DB_PASSWORD=password

# Generar la clave de la aplicación
RUN php artisan key:generate

# Migrar la base de datos (asegúrate de que la base de datos esté accesible)
RUN php artisan migrate

# Ajustar permisos
RUN chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Habilitar mod_rewrite y reiniciar Apache
RUN a2enmod rewrite
RUN service apache2 restart

# Exponer puerto
EXPOSE 80
