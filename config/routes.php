<?php
use Cake\Routing\Router;

Router::plugin(
    'ZuluruBootstrap',
    ['path' => '/zulurubootstrap'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
