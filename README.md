# Project Template

This is a highly opinionated template for new Laravel/Vue projects.

The Docker Back End is supported by several Docker Images

* Application Image - PHP 8.5-FPM Hosts the primary application.
* Reverb Image - PHP 8.5-FPM handles WebSocket Communication
* Horizon Image - PHP 8.5-FPM handles all background jobs in the Laravel Work Queue
* Scheduler Image - PHP 8.5-FPM handle all scheduled Laravel tasks
* NGINX Image - NGINX primary web proxy
* Database Image - MySQL 9.4 holds the application database
* Redis Image - Redis holds cache and session data

Template is setup with the following dependencies by default:

* Laravel 13
* Vue 3
* InertiaJS 3
* Tailwinds 4
