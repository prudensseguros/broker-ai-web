#!/bin/sh

# Asegurar permisos
chown -R www:www /var/www/storage /var/www/bootstrap/cache

# Optimizar Laravel para producción
cd /var/www
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar que los assets existen (debug)
echo "===== Checking assets at startup ====="
ls -la /var/www/public/build/ || echo "WARNING: No build directory!"

# Iniciar supervisor
supervisord -c /etc/supervisor/conf.d/supervisord.conf