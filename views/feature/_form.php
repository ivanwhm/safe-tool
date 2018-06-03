<?php
/**
 * Displays the create page to Feature CRUD.
 *
 * @var $this View
 * @var $model Feature
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\Epic;
use app\models\Feature;
use app\models\Product;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

echo Html::beginTag('div', ['class' => 'feature-form']);

$form = SafeToolActiveForm::begin(['id' => 'feature-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'feature')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbFeature'
]);

echo $form->field($model, 'product_id')->widget(Select2::class, [
	'data' => Product::getProducts(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbProductID',
		'id' => 'SelectProductID'
	]
]);

echo $form->field($model, 'epic_id')->widget(DepDrop::class, [
	'type' => DepDrop::TYPE_SELECT2,
	'data' => Epic::getEpics($model->getAttribute('product_id')),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbEpicID',
		'id' => 'SelectEpicID'
	],
	'pluginOptions' => [
		'depends' => ['SelectProductID'],
		'placeholder' => '---',
		'url' => Url::to(['epic/epics']),
	]
]);

echo $form->field($model, 'benefit_hypothesis')->textarea([
	'maxlength' => true,
	'rows' => '5',
	'aria-describedby' => 'hbBenefitHypothesis'
]);

echo $form->field($model, 'acceptance_criteria')->textarea([
	'maxlength' => true,
	'rows' => '10',
	'aria-describedby' => 'hbAcceptanceCriteria'
]);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model);
SafeToolActiveForm::end();

echo Html::endTag('div');