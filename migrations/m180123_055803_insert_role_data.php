<?php

use yii\db\Migration;

/**
 * Class m180123_055803_insert_role_data
 */
class m180123_055803_insert_role_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('role', [
            'id' => 1,
            'name' => 'Администратор',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('role', [
            'id' => 2,
            'name' => 'Пользователь',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_055803_insert_role_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_055803_insert_role_data cannot be reverted.\n";

        return false;
    }
    */
}
