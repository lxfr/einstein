<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Information]].
 *
 * @see Information
 */
class InformationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Information[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Information|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
