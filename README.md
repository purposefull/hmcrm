HealthMarketing CRM
=======

A Symfony project created on October 24, 2015, 11:38 pm.

# Install

1) git clone ...

2) composer install
3) php app/check.php
4) php app/console doctrine:create:database
5) php app/console doctrine:schema:update --force
6) php app/console doctrine:fixtures:load
7) php app/console server:start
8) http://127.0.0.1

# Postgresql

1) sudo apt-get install php7.0-postgresql
2) sudo -u postgres psql postgres
3) \password postgres
4) Double type password for user postgres