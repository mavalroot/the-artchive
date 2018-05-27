<?php

namespace common\utilities;

use Yii;

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

    public function setSeen($model, $prop)
    {
        if ($model->$prop == Yii::$app->user->id) {
            $model->seen = true;
            return $model->save();
        }
        return false;
    }
}
