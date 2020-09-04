<?php

namespace backend\modules\transport\models;

/**
 * This is the ActiveQuery class for [[TransportDriver]].
 *
 * @see TransportDriver
 */
class TransportDriverQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TransportDriver[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransportDriver|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
