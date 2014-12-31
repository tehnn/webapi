<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Yii Blog Demo',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '1234',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'curl' => array(
            'class' => 'ext.Curl',
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'db' => array(
            'connectionString' => 'sqlite:protected/data/blog.db',
            'tablePrefix' => 'tbl_',
        ),
        // uncomment the following to use a MySQL database
        /*
          'db'=>array(
          'connectionString' => 'mysql:host=localhost;dbname=blog',
          'emulatePrepare' => true,
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          'tablePrefix' => 'tbl_',
          ),
         */
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                
                // REST patterns
                array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                array('api2/list', 'pattern' => 'api2/<model:\w+>', 'verb' => 'GET'),
                array('api2/view', 'pattern' => 'api2/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api2/update', 'pattern' => 'api2/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('api2/delete', 'pattern' => 'api2/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('api2/create', 'pattern' => 'api2/<model:\w+>', 'verb' => 'POST'),
                // Other controllers
                
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
