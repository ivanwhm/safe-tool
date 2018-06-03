<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Language;
use app\models\enums\Status;
use app\models\User;
use kartik\password\PasswordInput;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;

$userNameHelp = Yii::t('user', 'Input the name of the user.');
$usernameHelp = Yii::t('user', 'Input the username.');
$emailHelp = Yii::t('user', 'Input the e-mail address.');
$passwordHelp = Yii::t('user', 'Input the password.');
$repeatPasswordHelp = Yii::t('user', 'Input the password (again).');
$languageHelp = Yii::t('user', 'Input the language.');
$activeHelp = Yii::t('user', 'Please tell if the user is active or inactive.');

echo Html::beginTag('div', ['class' => 'user-form']);

$form = SafeToolActiveForm::begin(['id' => 'user-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'name')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbName'
], $userNameHelp);

if ($model->getIsNewRecord()) {
	echo $form->field($model, 'username')->textInput([
		'maxlength' => true,
		'aria-describedby' => 'hbUsername'
	], $usernameHelp);
}

echo $form->field($model, 'email')->textInput([
	'maxlength' => true,
	'aria-describedby' => 'hbEmail'
], $emailHelp);

echo $form->field($model, 'password')->widget(PasswordInput::class, [
	'options' => [
		'aria-describedby' => 'hbPassword'
	],
	'pluginOptions' => [
		'showMeter' => true,
		'toggleMask' => true
	]
], $passwordHelp);

echo $form->field($model, 'new_password')->widget(PasswordInput::class, [
	'options' => [
		'aria-describedby' => 'hbNewPassword'
	],
	'pluginOptions' => [
		'showMeter' => true,
		'toggleMask' => true
	]
], $repeatPasswordHelp);

echo $form->field($model, 'language')->widget(Select2::class, [
	'data' => Language::getData(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbLanguage'
	]
], $languageHelp);

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