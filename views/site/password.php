<?php
/**
 * Displays the change password page to User CRUD.
 *
 * @var $this View
 * @var $model ChangePasswordForm
 * @var $updated boolean
 * @var $user User
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Icons;
use app\models\forms\ChangePasswordForm;
use app\models\User;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('password', 'Change password');
$this->params['breadcrumbs'] = [[
	"label" => Yii::t('password', 'Change password'),
	"icon" => Icons::getIcon(Icons::USER_PASSWORD),
	"active" => false,
	"url" => Url::to(["site/password"])
]];

echo Html::beginTag('div', ['class' => 'change-password-form']);

$form = SafeToolActiveForm::begin(['id' => 'change-password-form']);
$form->printErrorSummary($model);

if ($updated) {
	echo Html::beginTag('div', ['class' => 'alert alert-success alert-dismissable']);
	echo Html::button('&times;', [
		'class' => 'close',
		'data-dismiss' => 'alert',
		'aria-hidden' => 'true',
	]);
	echo Yii::t('password', 'Password changed successfully.');
	echo Html::endTag('div');
}

echo $form->field($model, 'oldPassword')->widget(
	PasswordInput::class, [
	'options' => [
		'autofocus' => true,
		'aria-describedby' => 'hbOldPassword'
	],
	'pluginOptions' => [
		'showMeter' => false,
		'toggleMask' => true
	]
]);

echo $form->field($model, 'newPassword')->widget(
	PasswordInput::class, [
	'options' => [
		'aria-describedby' => 'hbNewPassword'
	],
	'pluginOptions' => [
		'showMeter' => true,
		'toggleMask' => true
	]
]);

echo $form->field($model, 'repeatNewPassword')->widget(
	PasswordInput::class, [
	'options' => [
		'aria-describedby' => 'hbRepeatNewPassword'
	],
	'pluginOptions' => [
		'showMeter' => true,
		'toggleMask' => true
	]
]);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($user, false);
echo $form->printFormButtons($user, Yii::t('password', 'Change password'), 
	Icons::CRUD_EDIT, ['site/index'], ['site/index']);
SafeToolActiveForm::end();

echo Html::endTag('div');

