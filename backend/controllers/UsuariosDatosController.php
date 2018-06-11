<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\UsuariosCompleto;
use common\models\UsuariosDatos;
use common\utilities\ArtchiveCBase;

/**
 * UsuariosDatosController implements the CRUD actions for UsuariosDatos model.
 */
class UsuariosDatosController extends ArtchiveCBase
{
    use \common\utilities\Permisos;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeAdmin(['update']),
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

    public function whatIDo()
    {
        return ['find'];
    }

    public function actionUpdate($id)
    {
        $username = UsuariosCompleto::findOne(['id' => $id])->username;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/usuarios-completo/view', 'username' => $username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
