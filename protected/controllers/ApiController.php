<?php

namespace app\controllers;

use yii\web\Controller;
use app\services\ServiceApiTrait;
use app\models\Url;

/**
 * Класс для приёма запросов апи.
 *
 * @package app\controllers
 */
class ApiController extends Controller
{
    use ServiceApiTrait;

    /**
     * Экшен для приема данных апи.
     *
     * @return string
     */
    public function actionShortUrl()
    {
        if(\Yii::$app->request->isPost) {
            $url = new Url;
            $url->setAttributes(\Yii::$app->request->post());
            if(! $url->save()) {
                return $this->addError('Укажите ссылку');
            }

            return $this->addData(['url' => $url->short_id]);
        }

        return $this->addError('Method Not Allowed', 405);
    }
}
