<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
	'id' => 'safe-tool',
	'name' => 'Scaled Agile Framework Tool',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'language' => 'en-US',
	'sourceLanguage' => 'en-US',
	'timeZone' => 'UTC',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'layout' => 'sbadmin2',
	'components' => [
		'db' => $db,
		'request' => [
			'cookieValidationKey' => 'yK45pNRKblPIb4BFgC-CFP-XOacwnZXI',
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
		'formatter' => [
			'datetimeFormat' => 'short',
			'dateFormat' => 'short',
			'timeFormat' => 'short',
			'nullDisplay' => ''
		],
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
				],
			],
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\DbTarget',
					'levels' => ['info', 'error', 'warning'],
				],
			],
		],
	],
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
}

return $config;
