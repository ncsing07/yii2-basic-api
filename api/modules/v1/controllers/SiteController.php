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
            unset($result['password']);
            unset($result['access_token']);
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

        if ($result) {

            $user = Yii::$app->user->identity;
            unset($user['password']);
            unset($user['access_token']);
            unset($user['expire_at']);
            unset($user['created_at']);

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

    public function actionLogout()
    {
        $user = Yii::$app->user->identity;

        if ($user) {
            $user->access_token = NULL;
            $user->save(false);
            
            Yii::$app->user->logout(false);

            echo json_encode(array('status' => 1, 'code' => 200, 'message' => 'Successfully logout!'), JSON_PRETTY_PRINT);

            Yii::$app->end();
        }
    }

}
