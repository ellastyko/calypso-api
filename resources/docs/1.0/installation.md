**Requirements**

+ PHP < 7.3
+ MySQL 6.x
+ Composer 2.x

**To host the API just follow these steps:**
1. Check the requirements ☝️
2. [Clone repository](https://github.com/ellastyko/calypso-api)
3. Open folder in your terminal and run `make setup`

## Short commands from Makefile
| Makefile command | Full command                      | Description                |
|:-----------------|:----------------------------------|:---------------------------|
| `make setup`     | -                                 | Setup project              |
| `make start`     | -                                 | Start docker and npm watch |
| `make env`       | `cp .env.example .env`            | Copy .env.example to .env  |
| `make deps`      | `composer install && npm install` | Download dependencies      |
| `make migrate`   | `php artisan migrate`             | Make migrations            |
| `make refresh`   | `php artisan migrate:refresh`     | Refresh migrations         |
| `make seeds`     | `php artisan db:seed`             | Seed database              |
| `make test`      | `php artisan test`                | Start testing              |

