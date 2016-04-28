HealthMarketing CRM
=======

Open Source CRM for Small Business

http://crm.healthmarketing.me - SaaS implementation.

# System Requirements

1) PHP 7.0.x

2) PostgreSQL 9.3 or MySQL 5.7

3) Composer - https://getcomposer.org/

4) Git

# Install [Linux]

1) git clone git@github.com:andreybolonin/hmcrm.git

2) composer install

3) php bin/symfony_requirements

4) php bin/console doctrine:database:create

5) php bin/console doctrine:schema:update --force

6) php bin/console doctrine:fixtures:load

7) php bin/console server:start

8) http://127.0.0.1:8000

# Roadmap

1) Import

2) Tasks integration

3) User ACL

4) Phone calls integration

5) Reports

# Contributing

1) Project standards - https://github.com/FriendsOfPHP/PHP-CS-Fixer

2) Fork the repo and open Pull Requests on an opened issues
