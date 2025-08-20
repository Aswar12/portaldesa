#!/bin/bash

# Deploy script untuk upload controller ke production server
# Pastikan Anda memiliki akses SSH ke server production

echo "🚀 Starting deployment..."

# Upload controller yang sudah diperbaiki
echo "📤 Uploading InfografisController..."
scp app/Http/Controllers/InfografisController.php user@desa.antarkanmaa.my.id:/path/to/project/app/Http/Controllers/

# Upload view yang sudah diperbaiki  
echo "📤 Uploading penduduk view..."
scp resources/views/infografis/penduduk.blade.php user@desa.antarkanmaa.my.id:/path/to/project/resources/views/infografis/

# SSH ke server dan jalankan cache clear
echo "🔄 Clearing caches on server..."
ssh user@desa.antarkanmaa.my.id << 'EOF'
cd /path/to/project
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan optimize:clear
EOF

echo "✅ Deployment completed!"
echo "🌐 Check: https://desa.antarkanmaa.my.id/infografis/penduduk"
