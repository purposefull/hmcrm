HealthMarketing CRM
=======

A Symfony project created on October 24, 2015, 11:38 pm.

# Install

1) git clone https://andreybolonin@bitbucket.org/andreybolonin/easymed.git

2) composer install

3) php app/check.php

4) php app/console doctrine:database:create

5) php app/console doctrine:schema:update --force

6) php app/console doctrine:fixtures:load

7) php app/console server:start

8) http://127.0.0.1:8000

# Postgresql

1) sudo apt-get install php7.0-postgresql

2) sudo -u postgres psql postgres

3) \password postgres

4) Double type password for user postgres