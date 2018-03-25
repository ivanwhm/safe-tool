<?php
/**
 * Displays the change password page to User CRUD.
 *
 * @var $this View
 * @var $model ChangePasswordForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use kartik\icons\Icon;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\forms\ChangePasswordForm;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('password', 'Change password');
$this->params['breadcrumbs'] = [[
		"label" => Yii::t('password', 'Change password'),
		"icon" => Icon::show('key'),
		"active" => false,
		"url" => Url::to(["site/password"])
	]];

$oldPasswordLabel = Icon::show('info-circle') . Yii::t('password', 'Input the old password.');
$newPasswordLabel = Icon::show('info-circle') . Yii::t('password', 'Input the new password.');
$repeatNewPasswordLabel = Icon::show('info-circle') . Yii::t('password', 'Input the new password (again).');
$changePasswordLabel = Icon::show('pencil') . Yii::t('password', 'Change password');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="change-password">

	<div class="change-password-form">

		<?php $form = ActiveForm::begin([
				'id' => 'change-password-form',
			]); ?>

		<?php if ($model->hasErrors()) : ?>
			<div class="alert alert-danger">
				<?= $form->errorSummary($model) ?>
			</div>
		<?php endif; ?>

		<?php if ($updated) : ?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= Yii::t('password', 'Password changed successfully.') ?>
			</div>
		<?php endif; ?>
		
		<?= $form->field($model, 'oldPassword')->widget(
			PasswordInput::class, [
				'options' => [
					'autofocus' => true, 
					'aria-describedby' => 'hbOldPassword'
				], 
				'pluginOptions' => [
					'showMeter' => false, 
					'toggleMask' => true
				]
			]) ?>
		
		<?= Html::tag('span', $oldPasswordLabel, [
			'id' => 'hbOldPassword', 
			'class' => 'help-block'
		]) ?>

		<?= $form->field($model, 'newPassword')->widget(
			PasswordInput::class, [
				'options' => [
					'aria-describedby' => 'hbNewPassword'
				], 
				'pluginOptions' => [
					'showMeter' => true, 
					'toggleMask' => true
				]
			]) ?>
		
		<?= Html::tag('span', $newPasswordLabel, [
			'id' => 'hbNewPassword', 
			'class' => 'help-block'
			]) ?>

		<?= $form->field($model, 'repeatNewPassword')->widget(
			PasswordInput::class, [
				'options' => [
					'aria-describedby' => 'hbRepeatNewPassword'
				], 
				'pluginOptions' => [
					'showMeter' => true, 
					'toggleMask' => true
				]
			]) ?>
		
		<?= Html::tag('span', $repeatNewPasswordLabel, [
			'id' => 'hbRepeatNewPassword', 
			'class' => 'help-block'
		]) ?>

		<br>

		<?= Html::tag('span', $mandatoryFields, [
			'class' => 'help-block'
		]) ?>
		
		<div class="form-group">
			<?= Html::submitButton($changePasswordLabel, ['class' => 'btn btn-success']) ?>
			<?= Html::a($cancelLabel, ['index'], ['class' => 'btn btn-danger']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

