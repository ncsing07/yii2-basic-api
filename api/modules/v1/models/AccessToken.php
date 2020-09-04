<?php

namespace api\modules\v1\models;

use yii\db\ActiveRecord;

class AccessToken extends ActiveRecord
{
    public static function tableName()
    {
        return 'access_token';
    }

    public static function generateAuthKey($user)
    {
        $accessToken = new AccessToken();
        $accessToken->user_id = $user->id;
        $accessToken->token = $user->auth_key;
        $accessToken->used_at = date("Y-m-d H:i:s");
        $accessToken->expire_at = date("Y-m-d H:i:s", strtotime("+3600 sec"));
        $accessToken->save();
    }
}