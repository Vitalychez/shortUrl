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

            return $this->renderJson(['data' => ['url' => $url->short_id]]);
        }

        return $this->addError('Method Not Allowed', 405);
    }
	
	/**
     * Метод формирует отрицательный ответ пользователю в виде JSON данных.
     *
     * @param mixed $error данные для формирования тела ошибки.
     * @param integer $statusCode код ответа сервера.
     *
     * @return Response
     */
    public function addError($error, $statusCode = 400)
    {
        return $this->renderJson(['error' => $error], $statusCode);
    }
	
	/**
     * Метод формирует ответ пользователю в виде JSON данных.
     *
     * @param array $params данные для формирования тела.
	 * @param integer $statusCode код ответа сервера.
     *
     * @return Response
     */
    public function renderJson($params = null, $statusCode = 200)
    {
		$response          = \Yii::$app->response;
        $response->format  = Response::FORMAT_JSON;
        $response->statusCode = $statusCode;
        $response->content = json_encode($params);
        return $response;
    }
}
