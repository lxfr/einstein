<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "knowledge".
 *
 * @property integer $id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $content
 * @property string $slug
 */
class Knowledge extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'knowledge';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_title', 'meta_description', 'content', 'slug'], 'required'],
            [['content'], 'string'],
            [['meta_title', 'meta_description', 'slug'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'content' => 'Content',
            'slug' => 'Slug',
        ];
    }

    /**
     * @inheritdoc
     * @return KnowledgeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KnowledgeQuery(get_called_class());
    }
}
