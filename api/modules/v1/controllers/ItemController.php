<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
// use yii\web\Controller;
// use yii\web\Response;
// use app\models\Item;

class ItemController extends Controller
{
    public $modelClass = 'app\models\Order';

    // public function actionIndex()
    // {
    //     $items = Item::find()->all();

    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     return [
	   //      'message' => 'hello world',
	   //      'code' => 200,
	   //      'data' => $items,
	   //  ];
    // }

}
