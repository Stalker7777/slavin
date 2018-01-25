<?php

use yii\db\Migration;

/**
 * Class m180123_073841_insert_points_data
 */
class m180123_073841_insert_points_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        for($i = 1; $i < 101; $i++) {

            $this->insert('points', [
                'id' => $i,
                'name' => 'Name point name point name point name point name point ' . $i,
                'address' => 'Address point address point address point address point address point ' . $i,
                'created_at' => time(),
                'updated_at' => time(),
            ]);

        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_073841_insert_points_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_073841_insert_points_data cannot be reverted.\n";

        return false;
    }
    */
}
