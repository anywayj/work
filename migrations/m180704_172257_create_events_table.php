<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events1`.
 */
class m180704_172257_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('events', [
            'id_event' => $this->primaryKey(),
            'caption' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('events');
    }
}
