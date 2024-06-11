#!/bin/bash

echo ">>>>>>>>>>>>>>> CONEXION A BD"
# Esperar a que el servicio de la base de datos esté disponible
until nc -z db 3306; do
    echo "Esperando a que la base de datos esté disponible..."
    sleep 1
done

# Ejecutar las migraciones de la base de datos
php artisan migrate --force

# Ejecutar el servidor PHP-FPM
exec php-fpm
