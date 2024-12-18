## Installation

# Build image

```
docker-compose up -d app
```

# Install composer for laravel

```
docker-compose exec app composer install

```

# Setup database

```
docker-compose exec app php artisan migrate:fresh --seed
```

# add config file .env

```
cp env-example .env
```

# generate key

```
docker-compose exec app php artisan key:generate
```

# run project

```
docker-compose down && docker-compose up -d
```

# Run bash terminal

```
docker-compose run app bash
```

---

# Step 1: Remove all containers

1. Stop all running containers

```
docker stop $(docker ps -aq)
```

2. Remove all containers

```
docker rm $(docker ps -aq)
```

# Step 2: Remove all images

```
docker rmi $(docker images -q)
```

# Step 3: Rebuild your Docker setup

```
docker-compose up --build
```
