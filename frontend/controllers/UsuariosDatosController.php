<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\User;
use common\models\UsuariosDatos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosDatosController implements the CRUD actions for UsuariosDatos model.
 */
class UsuariosDatosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['update'],
                'rules' => [
                    $this->mustBeMyAccount(['update']),
                ],
            ],
        ];
    }

    /**
     * Updates an existing UsuariosDatos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $username
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($username)
    {
        $model = $this->findModel($username);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->getUser()->touch('updated_at');
            return $this->redirect($model->getMiPerfil());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the UsuariosDatos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $username
     * @return UsuariosDatos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        $id = User::findOne(['username' => $username])->id;

        if (($model = UsuariosDatos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
