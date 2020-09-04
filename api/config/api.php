<?php

$db     = require(__DIR__ . '/../../config/db.php');
// $params = require(__DIR__ . '/../../config/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Items',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'api\modules\v1\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'request' => [
            // 'cookieValidationKey' => false,
            // 'enableCsrfValidation' => false,
            'cookieValidationKey' => 'avcuX9MFzvhlwphwLsn87vY5g4lEVikB',
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                     // Create API log in the standard log dir
                     // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'v1/items' => 'v1/item/index',

                'v1/sites' => 'v1/site/index',
                'POST v1/sites/register' => 'v1/site/register',
                'POST v1/sites/login' => 'v1/site/login',
            ],
        ], 
        'db' => $db,
        // 'params' => $params,
    ],
];

return $config;