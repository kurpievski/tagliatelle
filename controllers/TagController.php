<?php

namespace app\controllers;

use app\controllers\tag\TagSearchAction;
use app\models\UserTag;
use yii\data\ActiveDataProvider;

class TagController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'search' => TagSearchAction::class
        ];
    }

    public function actionTop()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => UserTag::find()
                ->with('tag')
                ->select(['tag_id', 'counter' => 'count(*)'])
                ->groupBy('tag_id'),
        ]);

        return $this->render('top', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
