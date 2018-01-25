<?php

use yii\db\Migration;

/**
 * Class m180123_074309_insert_books_data
 */
class m180123_074309_insert_books_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $books_id = 1;

        for($i = 1; $i < 101; $i++) {

            for($x = 1; $x < 11; $x++) {

                $this->insert('books', [
                    'id' => $books_id,
                    'name' => 'Name book name book name book name book name book ' . $books_id,
                    'description' => 'Description book description book description book description book description book description book description book description book description book description book ' . $books_id,
                    'author' => 'Author book ' . $books_id,
                    'date' => strtotime("1 October 2000"),
                    'image_name' => 'img_preview.png',
                    'image_dir' => 'images',
                    'status' => 'free',
                    'points_id' => $i,
                    'use_user_id' => null,
                    'create_user_id' => 1,
                    'created_at' => time(),
                    'updated_at' => time(),
                ]);

                $books_id++;

            }
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180123_074309_insert_books_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180123_074309_insert_books_data cannot be reverted.\n";

        return false;
    }
    */
}
