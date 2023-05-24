<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%kategori}}`
 */
class m230524_183222_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'sagolovok' => $this->string(),
            'id_kategori' => $this->integer()->notNull(),
            'info_news' => $this->string(),
        ]);

        // creates index for column `id_kategori`
        $this->createIndex(
            '{{%idx-news-id_kategori}}',
            '{{%news}}',
            'id_kategori'
        );

        // add foreign key for table `{{%kategori}}`
        $this->addForeignKey(
            '{{%fk-news-id_kategori}}',
            '{{%news}}',
            'id_kategori',
            '{{%kategori}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%kategori}}`
        $this->dropForeignKey(
            '{{%fk-news-id_kategori}}',
            '{{%news}}'
        );

        // drops index for column `id_kategori`
        $this->dropIndex(
            '{{%idx-news-id_kategori}}',
            '{{%news}}'
        );

        $this->dropTable('{{%news}}');
    }
}
