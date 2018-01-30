<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complex".
 *
 * @property integer $id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $complex_description
 * @property string $slug
 */
class Complex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_title', 'meta_description', 'complex_description', 'slug'], 'required'],
            [['complex_description'], 'string'],
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
            'complex_description' => 'Complex Description',
            'slug' => 'Slug',
        ];
    }

    /**
     * @inheritdoc
     * @return ComplexQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ComplexQuery(get_called_class());
    }
}
