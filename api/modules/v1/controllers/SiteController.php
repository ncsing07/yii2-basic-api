<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use api\modules\v1\models\RegisterForm;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\User;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $response = Yii::$app->getResponse();
        $response->data = [
            'message' => 'hello world',
            'code' => 200,
        ];
        return $response;
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        $model->attributes = $this->request->get();

        $result = $model->signup();

        if ($result) {
        
            $response = Yii::$app->getResponse();
            $response->statusCode = 200;
            $response->data = [
                'status' => 1,
                'code' => 200,
                'data' => $result,
            ];

            return $response;
        }
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = $this->request->get();

        $result = $model->login();

        if ($user = $result) {
            $response = Yii::$app->getResponse();
            $response->statusCode = 200;
            $response->data = [
                'status' => 1,
                'code' => 200,
                'data' => $user,
            ];

            return $response;
        }
    }

}
