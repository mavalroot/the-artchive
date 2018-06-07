<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\utilities\ArtchiveCBase;
use frontend\models\DeleteAccountForm;

/**
 * INDEX
 */
class DeleteAccountController extends ArtchiveCBase
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
                    $this->mustBeLoggedForAll(),
                ],
            ],
        ];
    }

    public function init()
    {
        $this->class = new DeleteAccountForm();
        $this->search = null;
        parent::init();
    }

    /**
     * Abre la ventana para gestionar la baja del usuario, y desde ahí la gestiona.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->request->get('primary')) {
            $this->layout = 'secondary';
        }
        parent::actionIndex();
    }

    /**
     * Da de baja la cuenta actual.
     */
    public function actionDelete()
    {
        $model = new DeleteAccountForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->borrarTodo();
            if ($model->desactivarUsuario()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('frontend', 'Se ha dado de baja satisfactoriamente.'));
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('frontend', 'No se pudo dar de baja.'));
            }
            return $this->goHome();
        }
    }
}
