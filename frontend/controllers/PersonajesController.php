<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\Personajes;
use common\models\PersonajesSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PersonajesController implements the CRUD actions for Personajes model.
 */
class PersonajesController extends Controller
{
    use \common\utilities\Permisos;
    use \common\traitrollers\PersonajesComun;
    use \common\traitrollers\CommonIndex;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => $this->paramByPost(['delete']),
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    $this->mustBeLoggedForAll(),
                    $this->mustBeMyCharacter(['update', 'delete']),
                ],
            ],
        ];
    }

    /**
     * Lists all Personajes models.
     * @param string $username
     * @return mixed
     */
    public function actionIndex($username)
    {
        $user = User::findOne(['username' => $username]);

        if ($user) {
            $id = $user->id;
        }
        if (isset($id)) {
            $model = new PersonajesSearch();
            return $this->commonIndex($model, ['usuario_id' => $id], 'index');
        }
    }

    /**
     * Creates a new Personajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personajes();

        $model->usuario_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Personajes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'username' => Yii::$app->user->identity->username]);
    }
}
