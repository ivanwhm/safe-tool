<?php
/**
 * Displays the create page to User Role CRUD.
 *
 * @var $this View
 * @var $model UserRole
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Status;
use app\models\UserRole;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;

$nameHelp = Yii::t('user-role', 'Input the name of the user role.');
$descriptionHelp = Yii::t('user-role', 'Input the description of the user role.');
$activeHelp = Yii::t('user-role', 'Please tell if the user role is active or inactive.');

echo Html::beginTag('div', ['class' => 'user-role-form']);

$form = SafeToolActiveForm::begin(['id' => 'user-role-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'role')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbName'
], $nameHelp);

echo $form->field($model, 'description')->textarea([
	'rows' => '3',
	'aria-describedby' => 'hbDescription'
], $descriptionHelp);

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
