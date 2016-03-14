HealthMarketing CRM
=======

Almost Free and Open Source CRM for Small Business

http://easymed24.ru - SaaS implementation. Using temporary domain name, but service work in production environment.

# System Requirements

1) php 5.6 (php 7.x is better choice) - http://php.net

2) PostgreSQL 9.3 or MySQL 5.6 - http://www.postgresql.org/ or http://www.mysql.com/

3) Composer - https://getcomposer.org/

# Install [for Linux]

1) git clone git@github.com:andreybolonin/hmcrm.git

2) composer install

3) php app/check.php

4) php app/console doctrine:database:create

5) php app/console doctrine:schema:update --force

6) php app/console doctrine:fixtures:load

7) php app/console server:start

8) http://127.0.0.1:8000

# Database [PostgreSQL]

1) sudo apt-get install php7.0-postgresql

2) sudo -u postgres psql postgres

3) \password postgres

4) Double type password for user postgres

# Roadmap

1) Import

2) Tasks integration

3) User ACL

4) Phone calls integration

5) Voice control