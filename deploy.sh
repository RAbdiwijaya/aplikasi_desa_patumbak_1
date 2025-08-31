#!/bin/bash

echo "🚀 Starting deployment process..."

# Wait for database to be ready (optional)
echo "⏳ Waiting for database connection..."
sleep 5

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

if [ $? -eq 0 ]; then
    echo "✅ Migrations completed successfully"
else
    echo "❌ Migrations failed, retrying..."
    sleep 3
    php artisan migrate --force
fi

# Optimize application
echo "⚡ Optimizing application..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

echo "🎉 Deployment completed successfully!"
