<?php
/**
 * Reload project by update database schema, clear cache, install assets etc.
 */

function doCliAction($description, $command) {
    echo "\n* $description\n$command\n";
    passthru($command);
}

doCliAction('Delete current schema', 'php app/console doctrine:database:drop --force');
doCliAction('Delete current schema', 'php app/console doctrine:database:create');
doCliAction('Create database schema', 'php app/console doctrine:schema:create');
doCliAction('Clear cache', 'php app/console cache:clear');
doCliAction('Install assets', 'php app/console assets:install');
doCliAction('Load fixtures to database', 'php app/console doctrine:fixtures:load');
doCliAction('Changing permissions', 'sudo chmod -R 777 app/cache app/logs web/');
