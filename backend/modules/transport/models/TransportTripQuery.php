<?php

namespace backend\modules\transport\models;

/**
 * This is the ActiveQuery class for [[TransportTrip]].
 *
 * @see TransportTrip
 */
class TransportTripQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TransportTrip[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransportTrip|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
