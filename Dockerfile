FROM php:8.0

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip

# Install extensions
RUN docker-php-ext-install zip

# Copy composer.lock and composer.json
COPY composer.json /app

# Set working directory
WORKDIR /usr/src/app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /usr/src/app

# Install dependencies
RUN ["composer", "install"]
