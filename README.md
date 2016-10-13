HealthMarketing CRM
=======

[https://travis-ci.org/andreybolonin/hmcrm.svg?branch=master](123)

All-in-One Sales Platform for Small Business

http://crm.healthmarketing.me - SaaS implementation.

# System Requirements

1) PHP 7+

2) PostgreSQL 9.3+

3) Composer - https://getcomposer.org/

4) Git

# Installation

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

2) Calendar and Tasks (Google Calendar + Wunderlist)

3) Email autoresponders (MailerLite, GetResponse, MailChimp, Aweber)

4) RESTful API (RestBundle)

5) Product list

6) Email Templates + Email Server Config

7) Lead Prioritization (Scoring)


# Contributing

1) Project standards - https://github.com/FriendsOfPHP/PHP-CS-Fixer

2) Fork the repo and open Pull Requests on an opened issues

# Database [PostgreSQL]

1) sudo apt-get install php7.0-postgresql

2) sudo -u postgres psql postgres

3) \password postgres

4) Double type password for user postgres

# UI

https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S

http://blog.getbase.com/30-million-and-the-dawn-of-the-sales-platform

# Build with love by

Symfony

PostgreSQL

ChartJS

Font Awesome

Twitter Bootstrap

Google Calendar

Wunderlist