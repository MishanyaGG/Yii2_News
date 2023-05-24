<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pols}}`.
 */
class m230524_182918_create_pols_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pols}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->unique(),
            'pass' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pols}}');
    }
}
