<?php
use Cake\Routing\Router;

Router::plugin(
    'Bootstrap',
    ['path' => '/bootstrap'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
