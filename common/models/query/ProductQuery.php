<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Products]].
 *
 * @see \app\models\Products
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \app\models\Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
