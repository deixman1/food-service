FROM php:8.1-fpm-alpine

RUN cd /root/ \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && mv -v composer.phar /usr/local/bin/composer \
    && chmod 0755 /usr/local/bin/composer