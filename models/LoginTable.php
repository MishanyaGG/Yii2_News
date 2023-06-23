<?php

namespace app\models;

use yii\db\ActiveRecord;

class LoginTable extends ActiveRecord
{
    // Название таблицы
    public static function tableName()
    {
        return 'pols';
    }
}