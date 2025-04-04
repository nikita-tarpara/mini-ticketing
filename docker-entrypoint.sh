#!/bin/sh

# Wait for database to be ready
echo "Waiting for database connection..."
while ! nc -z mongodb 27017; do
  sleep 1
done

echo "Database is up! Running migrations..."
php artisan migrate --force

echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=8000
