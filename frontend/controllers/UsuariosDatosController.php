<?php

namespace frontend\controllers;

use Yii;
use yii\web\UploadedFile;

use yii\filters\AccessControl;

use common\models\User;
use common\models\UsuariosDatos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\utilities\ArtchiveCBase;

/**
 * UsuariosDatosController implements the CRUD actions for UsuariosDatos model.
 */
class UsuariosDatosController extends ArtchiveCBase
{
    use \common\utilities\Permisos;

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

    public function init()
    {
        $this->class = new UsuariosDatos();
        $this->search = null;
        parent::init();
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

        if ($model->load(Yii::$app->request->post())) {
            $model->foto = UploadedFile::getInstance($model, 'foto');
            if ($model->save()) {
                $model->upload();
                $model->getUser()->touch('updated_at');
                return $this->redirect($model->getMiPerfil());
            }
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
    public function findModel($username)
    {
        $id = User::findOne(['username' => $username])->id;

        if (($model = UsuariosDatos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página requerida no existe.'));
    }
}
