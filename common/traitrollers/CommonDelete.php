<?php

namespace common\traitrollers;

use Yii;

use yii\base\Model;

/**
 *
 */
trait CommonDelete
{
    /**
     * Deletes an existing Publicaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
