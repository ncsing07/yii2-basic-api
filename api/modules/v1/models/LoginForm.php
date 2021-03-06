<?php
namespace api\modules\v1\models;

use Yii;
use yii\base\Model;
use api\modules\v1\models\User;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    // public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            // ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            // return Yii::$app->user->login($this->getUser());
            $user = User::findByUsername($this->username);
            $user->generateAuthKey();
            $user->save();

            return $user;

        } else {
            $errors = $this->getErrors();

            $response = Yii::$app->getResponse();
            $response->statusCode = 400;

            echo json_encode(array('status' => 0, 'code' => 400, 'errors' => $errors), JSON_PRETTY_PRINT);

            Yii::$app->end();
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
