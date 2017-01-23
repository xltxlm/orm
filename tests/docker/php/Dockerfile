FROM php:fpm
COPY / /root/

RUN cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && cd /root/ &&  tar -xzf /root/donkeyid-donkeyid-1.0.tar.gz \
    && cd /root/donkeyid-donkeyid-1.0/donkeyid/  && /usr/local/bin/phpize && ./configure --with-php-config=/usr/local/bin/php-config \
    && make && make install && echo "extension=donkeyid.so" >/usr/local/etc/php/conf.d/donkeyid.ini

