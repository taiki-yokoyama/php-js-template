FROM php:8.3-apache

# 基本ツール
RUN apt-get update && apt-get install -y \
    git unzip curl nano \
    && rm -rf /var/lib/apt/lists/*

# PHP拡張（PDO MySQL / mysqli）
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Apache 設定
COPY vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Node (Tailwind 用)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs

# Composer（必要なら）
COPY composer.json /var/www/
WORKDIR /var/www
RUN php -r "copy('https://getcomposer.org/installer','composer-setup.php');" \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && rm composer-setup.php \
  && composer install --no-interaction || true

# NPM セットアップ（Tailwind ビルド）
COPY package.json /var/www/
RUN npm install

# プロジェクトをマウント運用（compose の volumes で上書き）
WORKDIR /var/www/html

EXPOSE 80
