<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\filters\AccessControl;
use common\utilities\ArtchiveCBase;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ArtchiveCBase
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
        $this->class = new User();
        $this->search = null;
        parent::init();
    }

    public function whatIDo()
    {
        return ['find'];
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/usuarios-completo/view', 'username' => $model->username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
