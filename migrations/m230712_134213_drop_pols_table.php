<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%pols}}`.
 */
class m230712_134213_drop_pols_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%pols}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%pols}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
