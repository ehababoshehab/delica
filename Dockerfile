FROM php:8.0.10 as delica_orders_service
RUN apt-get update -y && apt-get install -y openssl zip unzip git libpng-dev zlib1g-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install \
  bcmath \
  ctype \
  fileinfo \
  pdo_mysql \
  pdo \
  tokenizer
RUN apt-get update -y && apt-get install -y libpng-dev libzip-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN apt-get update -y && apt-get install -y supervisor

WORKDIR /app
COPY . /app
COPY ./.env.example /app/.env

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 80

COPY ./Dockerfile-start /Dockerfile-start
RUN sed -i 's/\r$//g' /Dockerfile-start
RUN chmod +x /Dockerfile-start

COPY ./supervisor.conf /etc/supervisor/conf.d/supervisor.conf

ENTRYPOINT ["/Dockerfile-start"]
