<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return '{{%users}}';
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $accessToken = AccessToken::find()->where(['token' => $token])->andWhere(['>', 'expire_at', date("Y-m-d H:i:s")])->one();
        if(!$accessToken) return $accessToken;
        return User::findOne(['id' => $accessToken->user_id]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
        AccessToken::generateAuthKey($this);
    }
}
