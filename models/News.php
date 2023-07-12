<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $header
 * @property int $id_categories
 * @property string|null $information
 * @property string|null $date
 *
 * @property Categories $categories
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categories','header', 'information'], 'required'],
            [['id_categories'], 'default', 'value' => null],
            [['id_categories'], 'integer'],
            [['header', 'information'], 'string'],
            [['id_categories'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['id_categories' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'id_categories' => 'Id Categories',
            'information' => 'Information',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Categories::class, ['id' => 'id_categories']);
    }
}
