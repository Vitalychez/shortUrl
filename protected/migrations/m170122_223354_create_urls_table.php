<?php

use yii\db\Migration;
use app\models\Url;

/**
 * Создание таблицы для хранения коротких ссылок
 */
class m170122_223354_create_urls_table extends Migration
{
    /**
     * Наименование связанной с миграцией таблицы.
     *
     * @var string
     */
    protected $table;

    /**
     * Переопределенный метод конструктора.
     *
     * @param array $config конфиг.
     *
     */
    public function __construct(array $config = [])
    {
        $this->table = Url::tableName();

        parent::__construct($config);
    }

    /**
     * Инициализация миграции.
     *
     * @return void
     */
    public function up()
    {
        $this->createTable($this->table, [
            'short_id' => 'varbinary(6) NOT NULL',
            'url' => $this->string(255)->notNull(),
        ], 'DEFAULT CHARSET=utf8');

        $this->addPrimaryKey('', $this->table, 'short_id');
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTable($this->table);
    }
}
