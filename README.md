HealthMarketing CRM
=======

All-in-One Sales Platform for Small Business

http://crm.healthmarketing.me - SaaS implementation.

# System Requirements

1) PHP 7.x

2) PostgreSQL 9.3 or MySQL 5.7

http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/platforms.html

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

1) Import and Export

2) Calendar and Tasks (Google Calendar + Wunderlist)

3) Email autoresponders (MailerLite, GetResponse, MailChimp, Aweber)

4) VoIP providers integration ()

5) SMS providers integration (Nexmo, Twilio, Clickatell, Plivo, Tropo, TurboSMS, SMSRU)

6) Reports (ChartJS)

7) RESTful API (RestBundle)

8) Product list

9) Email Templates + Email Server Config

10) Lead Prioritization (Scoring)


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

Symfony Framework

ChartJS

Font Awesome

Bootstrap

Google Calendar

Wunderlist