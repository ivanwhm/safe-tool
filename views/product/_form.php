<?php
/**
 * Displays the create page to Product CRUD.
 *
 * @var $this View
 * @var $model Product
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Status;
use app\models\Product;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;

$productNameHelp = Yii::t('product', 'Input the name of the product.');
$activeHelp = Yii::t('product', 'Please tell if the product is active or inactive.');

echo Html::beginTag('div', ['class' => 'product-form']);

$form = SafeToolActiveForm::begin(['id' => 'product-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'name')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbName'
], $productNameHelp);

echo $form->field($model, 'status')->widget(SwitchInput::class, [
	'type' => SwitchInput::CHECKBOX,
	'options' => [
		'aria-describedby' => 'hbStatus'
	],
	'pluginOptions' => [
		'handleWidth' => 60,
		'onText' => Status::getStatusDescription(Status::ACTIVE),
		'offText' => Status::getStatusDescription(Status::INACTIVE),
		'onColor' => 'success',
		'offColor' => 'danger'
	]
], $activeHelp);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model);
SafeToolActiveForm::end();

echo Html::endTag('div');