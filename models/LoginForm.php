<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $login;
    public $pass;

    // Валидация
    public function rules()
    {
        return [
            [['login','pass'],'required']
        ];
    }

    // Названия полей
    public function attributeLabels()
    {
        return [
            'login'=>'Логин',
            'pass'=>'Пароль',
        ];
    }
}