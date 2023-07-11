<?php
require 'recipe/common.php';
require 'vendor/autoload.php';
// Configuration
set('repository', 'https://github.com/FabioF9/applifrais-GSB.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Serveur de déploiement
server('production', 'your_server_ip')
    ->user('deploy')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/html');

// Tâches de déploiement
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
])->desc('Déployer l\'application Yii2');

after('deploy', 'success');
