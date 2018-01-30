<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "information".
 *
 * @property integer $id
 * @property integer $book_id
 * @property string $text
 *
 * @property Book $book
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'text'], 'required'],
            [['book_id'], 'integer'],
            [['text'], 'string', 'max' => 2000],
            [['text'], 'unique'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @inheritdoc
     * @return InformationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InformationQuery(get_called_class());
    }
}
