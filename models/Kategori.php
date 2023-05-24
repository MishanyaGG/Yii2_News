<?php
    namespace app\models;

    use yii\db\ActiveRecord;

    class Kategori extends ActiveRecord{
        public static function tableName()
        {
            return 'kategori';
        }
    }