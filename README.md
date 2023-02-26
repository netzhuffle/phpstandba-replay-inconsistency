Test repository for [staabm/phpstan-dba#552](https://github.com/staabm/phpstan-dba/issues/552).

```sh
docker compose up -d
docker compose run php composer install

docker compose run php vendor/bin/phpstan analyse

docker compose rm -fs mariadb
docker compose run php vendor/bin/phpstan analyse
```
