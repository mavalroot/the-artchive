<?php

namespace backend\controllers;

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
        return ['update', 'find'];
    }
}
