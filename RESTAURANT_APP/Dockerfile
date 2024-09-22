FROM php:apache
RUN docker-php-ext-install pdo pdo_mysql

COPY init.sql /docker-entrypoint-initdb.d/