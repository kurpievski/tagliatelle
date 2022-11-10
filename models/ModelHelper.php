<?php

namespace app\models;


use yii\db\ActiveRecord;
use yii\db\Exception;

class ModelHelper
{
    public static function getOrCreate(string $class, array $data, string $errorMsg = null): ActiveRecord
    {
        /** @var ActiveRecord $class */
        $activeRecord = $class::find()->where($data)->one();

        if (!$activeRecord) {
            /** @var ActiveRecord $activeRecord */
            $activeRecord = new $class($data);
            if (!$activeRecord->save()) {
                throw new Exception(
                    $errorMsg
                        ?? 'Problem saving model: '.implode('; ', $activeRecord->getFirstErrors()), $activeRecord
                );
            }
        }

        return $activeRecord;
    }
}