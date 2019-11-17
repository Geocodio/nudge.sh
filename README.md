# nudge.sh

## Stack

* **Backend:** Laravel 6
* **Frontend:** Tailwind CSS
* **Infrastructure:** Hosted on AWS Lambda via Laravel Vapor

## Development

### Install dependencies
```
composer install
npm install
```

### Development server
```
# Run database migrations
php artisan migrate

# Start development server and frontend asset watcher
php artisan serve
npm run watch
```

## Deployment

```
vapor deploy production
```
