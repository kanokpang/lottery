<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class Model extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array  $multipleModels
     * @param string $scenario
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [], $scenario = '')
    {
        /* @var $model Model */
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
                if ($scenario) {
                    $models[$i]->setScenario($scenario);
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}
