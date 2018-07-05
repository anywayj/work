<?php

use yii\db\Migration;

/**
 * Handles the creation of table `bids1`.
 */
class m180704_172448_create_bids_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('bids', [
            'id' => $this->primaryKey(),
            'id_event' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'price' => $this->double()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('bids');
    }
}
