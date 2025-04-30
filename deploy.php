<?php
namespace Deployer;

require 'recipe/symfony.php';

set('application', 'DemoFG');

// Config

set('repository', 'git@github.com:aswinimonicar/demosf.git');

add('shared_files', []);
add('shared_dirs', ['var/log', 'var/cache']);
//add('shared_dirs', []);
add('writable_dirs', ['var']);
//add('writable_dirs', []);

// Hosts
host('production')
    ->setHostname('10.10.100.57')
    ->setRemoteUser('fairgateadmin')
    ->setDeployPath('/home/fairgateadmin/test/demosf');
//host('10.10.100.57')
//    ->set('remote_user', 'deployer')
//    ->set('deploy_path', '~/test/demosf');

// Tasks

desc('Custom deploy sequence');
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:cache:clear',
    'deploy:publish',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:cleanup'
]);


// Hooks

after('deploy:failed', 'deploy:unlock');
