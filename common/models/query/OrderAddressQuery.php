<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[OrderAddress]].
 *
 * @see OrderAddress
 */
class OrderAddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderAddress[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderAddress|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
