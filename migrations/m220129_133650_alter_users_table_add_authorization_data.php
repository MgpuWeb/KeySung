<?php

use yii\db\Migration;

/**
 * Class m220129_133650_alter_users_table_add_remember_me_token_field
 */
class m220129_133650_alter_users_table_add_authorization_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'remember_me_token', $this->text()->null());
        $this->addColumn('users', 'status', $this->smallInteger()->notNull()->defaultValue(0));
        $this->addColumn('users', 'email_confirmation_token', $this->string()->unique()->after('email'));
        $this->alterColumn('users', 'email', $this->string()->unique()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'remember_me_token');
        $this->dropColumn('users', 'email_confirmation_token');
        $this->dropColumn('users', 'status');
        $this->alterColumn('users', 'email', $this->string()->notNull());
    }
}
