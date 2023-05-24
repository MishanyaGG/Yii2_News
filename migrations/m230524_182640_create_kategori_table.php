<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kategori}}`.
 */
class m230524_182640_create_kategori_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kategori}}', [
            'id' => $this->primaryKey(),
            'nasvanie' => $this->string()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kategori}}');
    }
}
