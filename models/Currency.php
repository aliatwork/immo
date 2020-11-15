<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Currency extends ActiveRecord
{

    public static function tableName()
    {
        return '{{currencies}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'insert_dt',
                'updatedAtAttribute' => 'insert_dt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

}