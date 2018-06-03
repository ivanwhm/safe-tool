<?php
/**
 * Displays the create page to Epic CRUD.
 *
 * @var $this View
 * @var $model Epic
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\EpicType;
use app\models\Epic;
use app\models\Product;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;

echo Html::beginTag('div', ['class' => 'epic-form']);

$form = SafeToolActiveForm::begin(['id' => 'epic-form']);

echo $form->printErrorSummary($model);

echo $form->field($model, 'title')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbTitle'
]);

echo $form->field($model, 'product_id')->widget(Select2::class, [
	'data' => Product::getProducts(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbProduct'
	]
]);

echo $form->field($model, 'type')->widget(Select2::class, [
	'data' => EpicType::getData(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbType'
	]
]);

echo $form->field($model, 'epic')->textarea([
	'rows' => '10',
	'aria-describedby' => 'hbEpic'
]);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model);
SafeToolActiveForm::end();

echo Html::endTag('div');
