<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%items}}`.
 */
class m200902_092745_create_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%items}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->double()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->datetime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%items}}');
    }
}
