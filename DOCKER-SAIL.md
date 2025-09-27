# DOCKER/SAIL SETUP

# Clone the project

```bash
git clone https://github.com/daniel-cintra/modular-demo.git && cd modular-demo
```

# Create the .env file

```bash
mv .env.example .env
```

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

By default the command above will set in the `.env`:

```bash
DB_CONNECTION=mysql
```

For the sake of simplicity, we will use SQLite. So, we need to change the `DB_CONNECTION` to `sqlite`.

```bash
DB_CONNECTION=sqlite
```

# Start sail

```bash
./vendor/bin/sail up -d
```

# SSH into the container

```bash
./vendor/bin/sail shell
```

# Follow the install instructions normally

Logged in the container, as mentioned in the previous step. Follow the [installation instructions](/README.md) normally, starting at the step `php artisan key:generate`.
