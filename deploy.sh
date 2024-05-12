echo "Deploying the application...\n"

echo "Installing dependencies...\n"
composer install --no-dev
if [ $? -ne 0 ]; then
    echo "Failed to install dependencies. Exiting..."
    exit 1
fi

echo "Optimizing the autoloader...\n"
composer dump-autoload --optimize
if [ $? -ne 0 ]; then
    echo "Failed to optimize the autoloader. Exiting..."
    exit 1
fi

echo "Create the .env file...\n"
php artisan env:decrypt --env=production --key=`cat .env.key`
if [ $? -ne 0 ]; then
    echo "Failed to decrypt the .env file. Exiting..."
    exit 1
fi
cp .env.production .env
if [ $? -ne 0 ]; then
    echo "Failed to create the .env file. Exiting..."
    exit 1
fi

echo "Generating the application key...\n"
php artisan key:generate
if [ $? -ne 0 ]; then
    echo "Failed to generate the application key. Exiting..."
    exit 1
fi

echo "Running database migrations...\n"
php artisan migrate --force --seed
if [ $? -ne 0 ]; then
    echo "Failed to run database migrations. Exiting..."
    exit 1
fi

echo "Clearing cache...\n"
php artisan cache:clear
if [ $? -ne 0 ]; then
    echo "Failed to clear cache. Exiting..."
    exit 1
fi

echo "Caching the configuration files...\n"
php artisan config:cache
if [ $? -ne 0 ]; then
    echo "Failed to cache the configuration files. Exiting..."
    exit 1
fi

echo "Caching the routes...\n"
php artisan route:cache
if [ $? -ne 0 ]; then
    echo "Failed to cache the routes. Exiting..."
    exit 1
fi

echo "Caching the views...\n"
php artisan view:cache
if [ $? -ne 0 ]; then
    echo "Failed to cache the views. Exiting..."
    exit 1
fi

echo "Caching any events...\n"
php artisan event:cache
if [ $? -ne 0 ]; then
    echo "Failed to cache the events. Exiting..."
    exit 1
fi

echo "Creating the symlink for the storage directory...\n"
php artisan storage:link
if [ $? -ne 0 ]; then
    echo "php artisan storage:link failed. Retrying with ln -s..."
    ln -s storage/app/public public/storage
    if [ $? -ne 0 ]; then
        echo "Failed to create the symlink for the storage directory. Exiting..."
        exit 1
    fi
fi

echo "Creating the upload directory...\n"
mkdir storage/app/public/uploads
if [ $? -ne 0 ]; then
    echo "Failed to create the upload directory. Exiting..."
    exit 1
fi

echo "Deployed the application successfully.\n"
