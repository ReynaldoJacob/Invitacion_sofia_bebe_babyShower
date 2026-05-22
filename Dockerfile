FROM serversideup/php:8.2-cli

# Cambiar a root para instalar Node.js
USER root

# Instalar Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json
COPY composer.json ./

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction 2>&1 || \
    composer install --no-dev --optimize-autoloader --no-interaction 2>&1 || true

# Instalar dependencias Node y compilar assets
COPY package.json package-lock.json ./
RUN npm ci 2>&1 || npm install 2>&1

COPY . .

RUN npm run build 2>&1 || true \
    && chmod -R 775 storage bootstrap/cache 2>&1 || true

# Railway asigna un puerto dinámico, mantener flexible
EXPOSE 80

CMD ["bash", "start.sh"]
