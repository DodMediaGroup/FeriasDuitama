<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Ferias de Duitama',
	'language'=>'es_CO',
	'sourceLanguage'=>'es_CO',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				'gii'=>'gii',
				'gii/<controller:\w+>'=>'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',

				/*'admin_ouna'=>'admin_ouna',
				'admin_ouna/<controller:\w+>'=>'admin_ouna/default/<controller>',
				'admin_ouna/<controller:\w+>/<id:\d+>'=>'admin_ouna/<controller>/view',
				'admin_ouna/<controller:\w+>/<action:\w+>'=>'admin_ouna/<controller>/<action>',
				'admin_ouna/<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin_ouna/<controller>/<action>',*/
				
				'api/<action:\w+>'=>'api/<action>',
				'api/<action:\w+>/<id:\d+>'=>'api/<action>',
				'<controller:\w+>/<id:\w+>'=>'<controller>/view',
				'<controller:\w+>'=>'site/<controller>'
			),
		),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
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
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sergioa@dodmediagroup.co',
		'contactEmail'=>'sergioa@dodmediagroup.co',
	),
);
