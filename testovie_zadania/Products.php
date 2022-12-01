<?php

namespace app\models;

use yii\db\ActiveRecord;

class Products extends ActiveRecord //модель для сохранения в БД в таблицу products
{
    /**
     * @property integer id
     * @property string category
     * @property string product_name
     * @property integer cost
     */



    public function rules()
    {
        return [
            [['cost', 'id'], 'integer' ],
            [['category', 'product_name'], 'string' ],
        ];
    }

}