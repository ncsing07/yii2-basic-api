<?php

namespace app\models;

use yii\db\ActiveRecord;

class Item extends ActiveRecord
{
    public static function tableName()
    {
        return 'items';
    }

}
