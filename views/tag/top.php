<?php

use kartik\icons\FontAwesomeAsset;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Top Tags';
$this->params['breadcrumbs'][] = $this->title;

FontAwesomeAsset::register($this);

?>
<div class="tag-top">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tag.name',
            'counter',
        ],
    ]); ?>

</div>
