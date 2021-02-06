FROM alpine:3.12

# download rsa pub php and move to php alpine rsa
ADD https://dl.bintray.com/php-alpine/key/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub

# make sure you can use HTTPS
RUN apk --update add ca-certificates

RUN echo "https://dl.bintray.com/php-alpine/v3.11/php-7.4" >> /etc/apk/repositories

# Install packages
RUN apk --no-cache add php php-fpm php-opcache php-openssl php-curl \
    nginx supervisor curl php-mysqli php-pdo_mysql php-pdo php-json \
    php-phar php-iconv php-mbstring php-ctype php-zlib php-session

# https://github.com/codecasts/php-alpine/issues/21
RUN ln -s /usr/bin/php7 /usr/bin/php

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Remove default server definition
RUN rm /etc/nginx/conf.d/default.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY config/php.ini /etc/php7/conf.d/custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html

# download billingbox
RUN  curl -LJO https://github.com/boxbilling/boxbilling/releases/download/4.21/BoxBilling.zip

# ngko comment
# COPY BoxBilling.zip /

# extract billingbox
RUN unzip -d /var/www/html BoxBilling.zip

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R  nobody.nobody /var/www/html && \
    chown -R nobody.nobody /run && \
    chown -R nobody.nobody /var/lib/nginx && \
    chown -R nobody.nobody /var/log/nginx

RUN chmod -R go+rw /var/www/html

# now prepare the bb data
RUN cd /var/www/html && cp bb-config-sample.php bb-config.php

# bb-config default url was localhost change to localhost:8004. so the asset and url won't 404
RUN cd /var/www/html && awk '{gsub(/localhost/,"localhost:8004")}1' bb-config.php > temp.txt && mv temp.txt bb-config.php

# Switch to use a non-root user from here on
USER nobody

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]