<?php

namespace app\services;

use yii\web\Response;

/**
 * Трэйт для обработки json ответа.
 *
 * @package app\services
 */
trait ServiceApiTrait
{
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
     * Метод формирует положительный ответ пользователю в виде JSON данных.
     *
     * @param mixed $data данные для формирования тела положительного ответа.
     * @param integer $statusCode код ответа сервера.
     *
     * @return Response
     */
    public function addData($data, $statusCode = 200)
    {
        return $this->renderJson(['data' => $data], $statusCode);
    }

    /**
     * Метод формирует ответ пользователю в виде JSON данных.
     *
     * @param array $params данные для формирования тела.
     * @param integer $statusCode код ответа сервера.
     *
     * @return Response
     */
    protected function renderJson($params, $statusCode)
    {
        $response          = \Yii::$app->response;
        $response->format  = Response::FORMAT_JSON;
        $response->statusCode = $statusCode;
        $response->content = json_encode($params);
        return $response;
    }
}