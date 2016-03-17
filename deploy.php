<?php

// All Deployer recipes are based on `recipe/common.php`.
require 'vendor/deployer/deployer/recipe/symfony.php';

serverList('app/config/servers.yml');

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'git@github.com:andreybolonin/hmcrm.git');