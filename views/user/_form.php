<?php

use app\controllers\tag\TagSearchAction;
use kartik\date\DatePicker;
use kartik\datecontrol\Module;
use kartik\icons\FontAwesomeAsset;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */

FontAwesomeAsset::register($this);

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'birthday_date')->widget(DatePicker::class, [
        'pluginOptions' => [
			'format' => 'dd.mm.yyyy'
		],
	]) ?>

	<?= $form->field($model, 'tags')->widget(Select2::class, [
        'options' => [
            'placeholder' => 'Enter tags...',
            'multiple' => true,
			'tags' => true,
			'maintainOrder' => true,
        ],
		'maintainOrder' => true,
        'initValueText' => !empty($model->userTags) ? ArrayHelper::getColumn($model->userTags, 'tag.name') : [],
        'pluginOptions' => [
            'tags' => true,
            'ajax' => [
                'url' => Url::to(['tag/search']),
                'data' => new JsExpression('function(params) { return {term : params.term ? params.term : ""}; }'),
                'processResults' => TagSearchAction::getProcessResultSelect2CallBack()
            ]
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
