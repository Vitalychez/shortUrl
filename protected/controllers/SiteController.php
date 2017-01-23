<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Url;

class SiteController extends Controller
{
    /**
     * Экшен главной страницы.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	/**
     * Возвращает массив внешних действий контроллера.
     *
     * @return array
     */
    public function actions()
    {
        if($url = Url::findOne(\Yii::$app->requestedRoute)) {
            header('Location: '. $url->url, true, 301);
        } else {
            return [
                'error' => [
                    'class' => \yii\web\ErrorAction::class,
                ],
            ];
        }
    }
}
