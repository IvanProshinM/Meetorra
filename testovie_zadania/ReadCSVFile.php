<?php

namespace app\controllers;

use app\models\Products;
use PhpParser\Node\Expr\Throw_;
use yii\db\Exception;
use yii\helpers\VarDumper;
use yii\web\Controller;

class ReadCSVFile extends Controller
{

    public function actionReadFile()
    {
        $i = 0;
        if (($stream = fopen("/var/www/html/example.csv", "r")) !== false) { //открываем CSV файл  с помощью функции fopen()
            while (($file = fgetcsv($stream, 5000, ",")) !== false) {  //считываем его с в ассоциативный массив с помощью функции fgetcsv
                [$id, $category, $name, $cost] = $file;

                if ($i++ === 0) {
                    continue;                                   //пропускаем первый элемент массива - заголовки таблицы
                }

                $model = Products::find()
                    ->where(['product_name' => $name])
                    ->one();
                if ($model === null) {                          //проверяем есть ли данные в бд
                    $model = new Products();                    //если нет, создаем новую запись, сохраняем её в БД
                }                                               //если есть, обновляем данные
                $model->id = $id;
                $model->category = $category;
                $model->product_name = $name;
                $model->cost = $cost;
                $model->save();
            }
        }
    }


}