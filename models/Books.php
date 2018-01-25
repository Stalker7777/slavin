<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $author
 * @property integer $date
 * @property string $image_name
 * @property string $image_dir
 * @property string $status
 * @property integer $points_id
 * @property integer $use_user_id
 * @property integer $create_user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createUser
 * @property Points $points
 * @property User $useUser
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author', 'date', 'image_name', 'image_dir', 'status', 'points_id', 'create_user_id', 'created_at', 'updated_at'], 'required'],
            [['description', 'status'], 'string'],
            [['date', 'points_id', 'use_user_id', 'create_user_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'author', 'image_name', 'image_dir'], 'string', 'max' => 255],
            [['create_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['create_user_id' => 'id']],
            [['points_id'], 'exist', 'skipOnError' => true, 'targetClass' => Points::className(), 'targetAttribute' => ['points_id' => 'id']],
            [['use_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['use_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'author' => 'Author',
            'date' => 'Date',
            'image_name' => 'Image Name',
            'image_dir' => 'Image Dir',
            'status' => 'Status',
            'points_id' => 'Points ID',
            'use_user_id' => 'Use User ID',
            'create_user_id' => 'Create User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateUser()
    {
        return $this->hasOne(User::className(), ['id' => 'create_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoints()
    {
        return $this->hasOne(Points::className(), ['id' => 'points_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUseUser()
    {
        return $this->hasOne(User::className(), ['id' => 'use_user_id']);
    }


    public function getDateText()
    {
        return date('d.m.Y', $this->date);
    }

    public function setDateText($value)
    {
        $this->date = strtotime($value);
    }

}
