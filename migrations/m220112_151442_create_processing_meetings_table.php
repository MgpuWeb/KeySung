<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meetings}}`.
 */
class m220112_151442_create_processing_meetings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('processing_meetings', [
            'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'processor_id' => $this->string()->null(),
			'type' => $this->string()->notNull(),
			'url' => $this->string()->notNull(),
			'date_start' => $this->dateTime()->notNull(),
			'date_end' => $this->dateTime()->notNull(),
        ]);

		// add foreign key for table `user`
		$this->addForeignKey(
			'fk-processing-meetings-user_id',
			'processing_meetings',
			'user_id',
			'users',
			'id',
		);

		$this->createIndex(
			'idx-processing-meetings-user_id',
			'processing_meetings',
			'user_id'
		);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('processing_meetings');
    }
}
