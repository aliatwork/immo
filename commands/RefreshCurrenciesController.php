<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use linslin\yii2\curl;
use app\models;

class RefreshCurrenciesController extends Controller
{

    private $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function actionIndex()
    {

        $curl = new curl\Curl();

        $response = $curl->get($this->url);

        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $currArr = json_decode($json, true);

        foreach ($currArr['Valute'] as $currItem) {
            $currency = models\Currency::find()
                ->where(['code' => $currItem['NumCode']])
                ->one();
            if (!$currency) {
                $currency = new models\Currency();
            }
            $currency->code = $currItem['NumCode'];
            $currency->name = $currItem['Name'] . ' (' . $currItem['CharCode'] . ')';
            $currency->rate = floatval(str_replace(',', '.', $currItem['Value']));
            $currency->save();
        }

        return ExitCode::OK;
    }
}
