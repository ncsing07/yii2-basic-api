<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;
use api\modules\v1\models\User;

class RegisterForm extends Model
{	
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username','password','email'],'required'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\api\modules\v1\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\api\modules\v1\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
        	$errors = $this->getErrors();

        	$response = Yii::$app->getResponse();
        	$response->statusCode = 400;

        	echo json_encode(array('status' => 0, 'code' => 400, 'errors' => $errors), JSON_PRETTY_PRINT);

            Yii::$app->end();
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        // $user->generateAuthKey();
        $user->created_at = date("Y-m-d H:i:s");
        
        return $user->save() ? $user : null;
    }

}
