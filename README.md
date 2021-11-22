# nudge.sh

## Stack

* **Backend:** Laravel 8
* **Frontend:** Tailwind CSS (v1.0)
* **Infrastructure:** Hosted on AWS Lambda via Laravel Vapor

## Development

### Install dependencies
```
composer install
npm install
```

### Development server
```
# Launch development server
sail up

# Run database migrations
sail artisan migrate

# Start frontend asset watcher
sail npm run watch
```

## Deployment

```
vapor deploy production
```
