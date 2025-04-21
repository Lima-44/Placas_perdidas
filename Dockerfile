FROM wyveo/nginx-php-fpm:php82

WORKDIR /usr/share/nginx/html

COPY . /usr/share/nginx/html
 
COPY config/nginx /etc/nginx 
