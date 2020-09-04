<?php

namespace api\modules\v1\controllers;

use Yii;
// use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use api\modules\v1\models\Item;
use yii\filters\AccessControl;

class ItemController extends Controller
{
    // public $modelClass = 'app\models\Item';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException('You are not allowed to access this page');
                }
            ],
        ];
    }

    public function actionIndex()
    {
        $items = Item::find()->all();

        return [
	        'message' => 'hello world',
	        'code' => 200,
	        'data' => $items,
	    ];
    }

}
