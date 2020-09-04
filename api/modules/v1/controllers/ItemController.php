<?php

namespace api\modules\v1\controllers;

use Yii;
// use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\Response;
use api\modules\v1\models\Item;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;

class ItemController extends Controller
{
    // public $modelClass = 'app\models\Item';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className()   
        ]; 
        return $behaviors;
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
