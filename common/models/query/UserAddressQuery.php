<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserAddress]].
 *
 * @see UserAddress
 */
class UserAddressQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserAddress[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserAddress|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
