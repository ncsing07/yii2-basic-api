<?php

use yii\db\Migration;

/**
 * Class m200904_082250_alter_users_table
 */
class m200904_082250_alter_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('users', 'access_token');
        $this->dropColumn('users', 'expire_at');
        $this->addColumn('users', 'auth_key', $this->string(32)->notNull()->after('password'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200904_082250_alter_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200904_082250_alter_users_table cannot be reverted.\n";

        return false;
    }
    */
}
