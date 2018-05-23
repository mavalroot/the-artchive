<?php

namespace common\utilities;

/**
 *
 */
trait Alerts
{
    public function getUnseenAlerts($model, $prop)
    {
        return $model->find()->where([$prop => $this->id, 'seen' => false])->count();
    }

    public function setSeenAllAlerts($model, $prop)
    {
        $model->updateAll(['seen' => true], "$prop = " . $this->id);
    }
}
