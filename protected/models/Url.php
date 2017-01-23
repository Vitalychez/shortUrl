<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель для взаимодействия с данными коротких ссылок.
 *
 * @package app\models
 *
 * @property string  $short_id
 * @property string  $url
 */
class Url extends ActiveRecord
{
    /**
     * Определение связанной с моделью таблицы СУБД.
     *
     * @return string
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * Определение правил валидации модели.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [
                ['url'],
                'required',
            ],
            ['url', 'url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * Предварительная инициализация данных.
     *
     * @param boolean $insert истина если создание нового токена.
     *
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $short = \Yii::$app->security->generateRandomString(6);
            while (static::findOne($short)) {
                $short = \Yii::$app->security->generateRandomString(6);
            }
            $this->short_id = $short;
            return true;
        }

        return false;
    }

    /**
     * Переопределенный метод сохранения данных.
     *
     * @param boolean $runValidation  инициализация валидации.
     * @param array   $attributeNames список атрибутов.
     *
     * @return boolean
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($model = static::findOne(['url' => $this->url])) {
            $this->setAttribute('short_id', $model->short_id);
            return true;
        }

        return parent::save($runValidation, $attributeNames);
    }
}
