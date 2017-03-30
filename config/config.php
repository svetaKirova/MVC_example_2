<?php
Config::set('site_name', 'Your Site Name');
Config::set('languages', array('en', 'ru'));

//Routes. Route name => method prefix
Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_',
));
Config::set('default_route', 'default');
Config::set('default_language', 'ru');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');