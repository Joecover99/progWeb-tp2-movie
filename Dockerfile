FROM php:7-apache

# Use the development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Install some dependencies
RUN apt-get update -y && apt-get install -y \
	openssl \
	zip \
	unzip \
	git \
    build-essential \
    apt-utils \
    wget \
    libxml2-dev \
    libonig-dev \
    libzip-dev

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php dependencies
RUN docker-php-ext-install \
	bcmath \
	pdo \
	mbstring \
	pdo_mysql
RUN docker-php-ext-enable pdo pdo_mysql

# Enable laravel website
WORKDIR /etc/apache2/sites-available
COPY laravel-apache.conf laravel.conf
RUN a2dissite 000-default.conf && \
	a2ensite laravel.conf && \
	a2enmod rewrite

# Enable node/npm