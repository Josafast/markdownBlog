FROM php:8.2-cli

RUN apt-get update && apt-get install -y git \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
RUN git config --global --add safe.directory .
RUN git clone https://github.com/Josafast/markdownBlog.git .

RUN composer install --no-progress --no-interaction

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80"]
