<?php

namespace api\modules\v1\models;

use yii\db\ActiveRecord;

class Item extends ActiveRecord
{
    public static function tableName()
    {
        return 'items';
    }

}
