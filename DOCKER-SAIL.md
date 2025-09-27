# DOCKER/SAIL SETUP

# Clone the project

`git clone https://github.com/daniel-cintra/modular-demo.git && cd modular-demo`

# Create the .env file

`mv .env.example .env`

# Install the dependencies

```bash
docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php84-composer:latest \
 composer install
```

# Sail scaffolding install

```bash
docker run --rm \
 -u "$(id -u):$(id -g)" \
 -v "$(pwd):/var/www/html" \
 -w /var/www/html \
 laravelsail/php84-composer:latest \
 php artisan sail:install
```

# Start sail

`./vendor/bin/sail up -d`

# SSH into the container

`./vendor/bin/sail shell`

# Follow the install instructions normally

Logged in the container, as mentioned in the previous step. Follow the [installation instructions](/README.md) normally, starting at the step `php artisan key:generate`.
