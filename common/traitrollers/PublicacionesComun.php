<?php

namespace common\traitrollers;

use Yii;

use yii\web\NotFoundHttpException;
use common\models\Publicaciones;

/**
 *
 */
trait PublicacionesComun
{
    use TodoComun;

    /**
     * Finds the Personajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Publicaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publicaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
