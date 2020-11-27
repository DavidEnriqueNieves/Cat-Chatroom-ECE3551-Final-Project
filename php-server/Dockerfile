FROM ubuntu
RUN apt-get update 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer require influxdb\influxdb-php
RUN apt install php-curl
EXPOSE 8080
ENTRYPOINT ["php", "-S", "localhost:8080"]

