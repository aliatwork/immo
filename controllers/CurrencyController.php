<?php

namespace app\controllers;

use app\models\Currency;
use yii\data\Pagination;
use yii\rest\ActiveController;

class CurrencyController extends ActiveController
{
    public $modelClass = 'app\models\Currency';

    public $serializer = [
        'class' => \yii\rest\Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    public function actionIndex()
    {
        $query = Currency::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

}
