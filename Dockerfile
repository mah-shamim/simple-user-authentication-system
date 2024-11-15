FROM php:5.6-cli

# Install required dependencies
RUN apt-get update && apt-get install -y unzip git curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
