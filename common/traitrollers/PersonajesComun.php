<?php

namespace common\traitrollers;

use Yii;

use yii\web\NotFoundHttpException;
use common\models\Personajes;

/**
 *
 */
trait PersonajesComun
// class PersonajesComun
{
    use CommonDelete;
    use CommonUpdate;
    use CommonView;

    /**
     * Finds the Personajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Personajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
