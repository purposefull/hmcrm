HealthMarketing CRM
=======

[![Build Status](https://travis-ci.org/andreybolonin/hmcrm.svg?branch=master)](https://travis-ci.org/andreybolonin/hmcrm)

All-in-One Sales Platform for Small Business

http://crm.healthmarketing.me - SaaS implementation.

# System Requirements

1) PHP 7+

2) PostgreSQL 9.3+

3) Composer

# Installation

1) composer create-project andreybolonin/hmcrm

2) bin/console doctrine:database:create && doctrine:schema:update --force

3) bin/console doctrine:fixtures:load

4) bin/console server:start

5) http://127.0.0.1:8000/login

# Roadmap

1) Import & Export

2) Calendar and Tasks (Google Calendar + Wunderlist)

3) Email autoresponders (MailerLite, GetResponse, MailChimp, Aweber)

4) RESTful API (RestBundle)

5) Product list

6) Email Templates + Email Server Config

7) Lead Prioritization (Scoring)


# Contributing

1) Coding standards - https://github.com/FriendsOfPHP/PHP-CS-Fixer

2) Phpunit tests will be passed


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