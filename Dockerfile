   FROM php:8.3-fpm

   # Install dependencies for the zip extension
   RUN apt-get update && apt-get install -y \
       libzip-dev \
       unzip \
       && docker-php-ext-install zip

   # Other configurations can go here