<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\models\Url;

/**
 * Класс для приёма запросов апи.
 *
 * @package app\controllers
 */
class ApiController extends Controller
{
    /**
     * Код ответа сервера.
     *
     * @var integer
     */
    protected $statusCode = 200;

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
                $this->statusCode = 405;
                return $this->renderJson(['error' => 'Укажите ссылку']);
            }

            return $this->renderJson(['data' => ['url' => $url->short_id]]);
        }

        $this->statusCode = 405;
        return $this->renderJson(['error' => 'Method Not Allowed']);
    }
	
	/**
     * Метод формирует ответ пользователю в виде JSON данных.
     *
     * @param array $params данные для формирования тела.
     *
     * @return Response
     */
    public function renderJson($params = null)
    {
		$response          = \Yii::$app->response;
        $response->format  = Response::FORMAT_JSON;
        $response->statusCode = $this->statusCode;
        $response->content = json_encode($params);
        return $response;
    }
}
