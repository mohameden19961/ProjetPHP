FROM php:8.4-cli
RUN docker-php-ext-install pdo pdo_mysql mysqli
WORKDIR /app
COPY . .
EXPOSE 8001
CMD ["php", "-S", "0.0.0.0:8001", "router.php"]
