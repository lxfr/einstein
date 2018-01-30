<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Complex]].
 *
 * @see Complex
 */
class ComplexQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Complex[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Complex|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
