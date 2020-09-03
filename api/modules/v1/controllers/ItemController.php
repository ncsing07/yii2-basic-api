<?php

namespace api\modules\v1\controllers;

use Yii;
// use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use api\modules\v1\models\Item;

class ItemController extends Controller
{
    // public $modelClass = 'app\models\Item';

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
