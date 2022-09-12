<?php
namespace frontend\components;

use yii\base\Component;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 29/4/2561
 * Time: 21:07
 */

class VisitorClass extends Component
{
    public function init()
    {
        $model = new \backend\models\Visitor();
        $model->ip = \Yii::$app->request->remoteIP;
        $model->visitorByDate = date('Y-m-d');
        $visitor = \backend\models\Visitor::find()->where(['ip' => $model->ip, 'visitorByDate' => $model->visitorByDate])->all();
        if (!$visitor) {
            $model->save();
        }
    }
}