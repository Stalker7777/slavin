<?php

use yii\db\Migration;

/**
 * Class m180123_060512_insert_user_data
 */
class m180123_060512_insert_user_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('user', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => 'yLPcheKTRk-CzX02GlKYjPyo165H1GTY',
            'password_hash' => '$2y$13$c4DifVT5NcGinGHGWFKoOO9gerwfoHqzNBCrwWGRdSzcn37uoXe36',
            'password_reset_token' => null,
            'email' => 'admin@mail.ru',
            'status' => 10,
            'role_id' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('user', [
            'id' => 2,
            'username' => 'user',
            'auth_key' => 'GEWNsoezwckOTjwOz_j0strbhSfyKZBm',
            'password_hash' => '$2y$13$osLHKnNfIBG0EpC2Er.8B.2ukuc9RgganloKsvAShxLwjtO9a.NT.',
            'password_reset_token' => null,
            'email' => 'user@mail.ru',
            'status' => 10,
            'role_id' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_060512_insert_user_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_060512_insert_user_data cannot be reverted.\n";

        return false;
    }
    */
}
