<?php

use app\controllers\tag\TagSearchAction;
use app\models\Tag;
use app\models\User;
use kartik\date\DatePicker;
use kartik\icons\FontAwesomeAsset;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

FontAwesomeAsset::register($this);

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'surname',
            'number',
            'address:ntext',
            [
                'attribute' => 'birthday_date',
				'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'birthday_date',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd'
                    ],
				]),
			],
			[
				'attribute' => 'tags',
				'value' => 'tagsString',
				'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'tags',
                    'options' => [
                        'placeholder' => 'Choose a tag...',
                    ],
                    'initValueText' => !empty($searchModel->tags) ? Tag::findOne($searchModel->tags)?->name : '',
                    'pluginOptions' => [
						'allowClear' => true,
                        'tags' => true,
                        'ajax' => [
                            'url' => Url::to(['tag/search']),
                            'data' => new JsExpression('function(params) { return {term : params.term ? params.term : ""}; }'),
                            'processResults' => TagSearchAction::getProcessResultSelect2CallBack()
                        ]
                    ]
                ])
			],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
