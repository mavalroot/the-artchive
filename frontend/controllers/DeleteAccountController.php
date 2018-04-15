<?php

namespace frontend\controllers;

use Yii;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use frontend\models\DeleteAccountForm;

class DeleteAccountController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'baja' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Abre la ventana para gestionar la baja del usuario, y desde ahí la gestiona.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new DeleteAccountForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->desactivarUsuario()) {
                $model->borrarTodo();
                Yii::$app->getSession()->setFlash('success', 'Se ha dado de baja satisfactoriamente.');
            } else {
                Yii::$app->getSession()->setFlash('error', 'No se pudo dar de baja.');
            }
            return $this->goHome();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
