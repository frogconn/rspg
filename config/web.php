<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'name' => 'RSPG System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'th',
    'components' => [
		    'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'view' => [
          'theme' => [
            'basePath' => '@app/themes/adminlte',
            'baseUrl' => '@web/themes/adminlte',
          ],
        ],
        'assetManager' => [
             'bundles' => [
                 'dmstr\web\AdminLteAsset' => [
                     'skin' => 'skin-green',
                 ],
             ],
         ],
        'menuHelper' => [
    			'class' => 'app\components\MenuHelper',
    		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Ixdk8YgAEis2nRwyiQF9zzngw-7mFIZ9',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
			'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
    			'enablePrettyUrl' => true,
    			'showScriptName' => false,
    			'rules' => [
    				'' => 'site/index',
    				'register' => 'site/register',
    				'view' => 'site/view',
                    'admin' => 'site/admin',
    				'page/<alias:[\w\W\d\D]+>' => 'site/content',
    				'<controller:\w+[-\w]*>/<id:\d+>' => '<controller>/view',
    				'<controller:\w+[-\w]*>/<action:\w+[-\w]*>/<id:\d+>' => '<controller>/<action>',
    				'<module:\w+[-\w]*>/<controller:\w+[-\w]*>/<action:\w+[-\w]*>' => '<module>/<controller>/<action>',
    			],
    		],
    ],
	'modules' => [
  
  'user-admin' => [
            'class' => 'mdm\admin\Module',
        ],
		'user' => [
			'class' => 'dektrium\user\Module',
			'enableUnconfirmedLogin' => true,
			'confirmWithin' => 21600,
			'cost' => 12,
			'admins' => ['admin'],
      ],
		],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
          //'site/login',
          '*',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
  		'class' => 'yii\gii\Module',
  		'allowedIPs' => ['*'],
  		'generators' => [ //here
  			'crud' => [ // generator name
  				'class' => 'yii\gii\generators\crud\Generator', // generator class
  				'templates' => [ //setting for out templates
  					'myCrud' => '@app/gii_template/crud/default', // template name => path to template
  				],
  			],
  		],
  	];
}

return $config;
