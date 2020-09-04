<?php

namespace backend\modules\transport\models;

/**
 * This is the ActiveQuery class for [[TransportVehicle]].
 *
 * @see TransportVehicle
 */
class TransportVehicleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TransportVehicle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TransportVehicle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
