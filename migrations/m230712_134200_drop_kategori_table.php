<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%kategori}}`.
 */
class m230712_134200_drop_kategori_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%kategori}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%kategori}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
