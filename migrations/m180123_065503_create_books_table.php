<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books`.
 */
class m180123_065503_create_books_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'author' => $this->string(255)->notNull(),
            'date' => $this->integer()->notNull(),
            'image_name' => $this->string(255)->notNull(),
            'image_dir' => $this->string(255)->notNull(),
            'status' => "enum('free','busy') COLLATE utf8_unicode_ci NOT NULL",
            'points_id' => $this->integer()->notNull(),
            'use_user_id' => $this->integer()->defaultValue(null),
            'create_user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'idx-books-points_id',
            'books',
            'points_id'
        );

        $this->addForeignKey(
            'fk-books-points_id',
            'books',
            'points_id',
            'points',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-books-use_user_id',
            'books',
            'use_user_id'
        );

        $this->addForeignKey(
            'fk-books-use_user_id',
            'books',
            'use_user_id',
            'user',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex(
            'idx-books-create_user_id',
            'books',
            'create_user_id'
        );

        $this->addForeignKey(
            'fk-books-create_user_id',
            'books',
            'create_user_id',
            'user',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('books');
    }
}
