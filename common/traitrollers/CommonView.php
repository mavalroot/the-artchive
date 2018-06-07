<?php

namespace common\traitrollers;

use Yii;

use yii\base\Model;

/**
 *
 */
trait CommonView
{
    /**
     * Displays a single model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function commonView($id, $tipo)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $tipo),
        ]);
    }
}
