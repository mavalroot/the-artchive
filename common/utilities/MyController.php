<?php

namespace common\utilities;

use Yii;

use yii\web\Controller;

class MyController extends Controller
{
    public function init()
    {
        $session = Yii::$app->session;
        parent::init();
        if (isset($session['language'])) {
            Yii::$app->language = $session['language'];
            return;
        }
        Yii::$app->language = 'es-ES';
        return;
    }
}
