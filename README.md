# Delica Code Challenge

## Steps to run this project locally:

Clone the repo :
```ini
git clone git@github.com:ehababoshehab/delica.git
```

### Run with Docker
RUN `docker build -t delica_orders_service . && docker run --name delica_orders_service delica_orders_service`

RUN `docker ps`

```ini
NAMES
delica_orders_service
```

RUN `docker exec -it delica_orders_service /bin/sh`

RUN `php artisan command:export-orders`

### Run without
Copy `.env.example` to `.env`

Run `composer install`

RUN `php artisan command:export-orders`

## Note : Make sure the ports 80
