<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 */
class m230710_125053_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'header' => $this->string(),
            'id_categories' => $this->integer()->notNull(),
            'information' => $this->string(),
            'date'=>$this->date()
        ]);

        // creates index for column `id_categories`
        $this->createIndex(
            '{{%idx-news-id_categories}}',
            '{{%news}}',
            'id_categories'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-news-id_categories}}',
            '{{%news}}',
            'id_categories',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-news-id_categories}}',
            '{{%news}}'
        );

        // drops index for column `id_categories`
        $this->dropIndex(
            '{{%idx-news-id_categories}}',
            '{{%news}}'
        );

        $this->dropTable('{{%news}}');
    }
}
