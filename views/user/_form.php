<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Language;
use app\models\User;
use kartik\icons\Icon;
use kartik\password\PasswordInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$userNameHelp = Icon::show('info-circle') . Yii::t('user', 'Input the name of the user.');
$usernameHelp = Icon::show('info-circle') . Yii::t('user', 'Input the username.');
$emailHelp = Icon::show('info-circle') . Yii::t('user', 'Input the e-mail address.');
$passwordHelp = Icon::show('info-circle') . Yii::t('user', 'Input the password.');
$repeatPasswordHelp = Icon::show('info-circle') . Yii::t('user', 'Input the password (again).');
$languageHelp = Icon::show('info-circle') . Yii::t('user', 'Input the language.');
$activeHelp = Icon::show('info-circle') . Yii::t('user', 'Please tell if the user is active or inactive.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="user-form">

	<?php $form = ActiveForm::begin(['id' => 'user-form']); ?>

	<?php if ($model->hasErrors()) : ?>
		<div class="alert alert-danger">
			<?= $form->errorSummary($model) ?>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'name')->textInput([
		'maxlength' => true,
		'autofocus' => true,
		'aria-describedby' => 'hbName'
	]) ?>

	<?= Html::tag('span', $userNameHelp, [
		'id' => 'hbName',
		'class' => 'help-block'
	]) ?>

	<?php if ($model->getIsNewRecord()) : ?>

		<?= $form->field($model, 'username')->textInput([
			'maxlength' => true,
			'aria-describedby' => 'hbUsername'
		]) ?>

		<?= Html::tag('span', $usernameHelp, [
			'id' => 'hbUsername',
			'class' => 'help-block'
		]) ?>

	<?php endif; ?>

	<?= $form->field($model, 'email')->textInput([
		'maxlength' => true,
		'aria-describedby' => 'hbEmail'
	]) ?>

	<?= Html::tag('span', $emailHelp, [
		'id' => 'hbEmail',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'password')->widget(PasswordInput::class, [
		'options' => [
			'aria-describedby' => 'hbPassword'
		],
		'pluginOptions' => [
			'showMeter' => true,
			'toggleMask' => true
		]]); ?>

	<?= Html::tag('span', $passwordHelp, [
		'id' => 'hbPassword',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'new_password')->widget(PasswordInput::class, [
		'options' => [
			'aria-describedby' => 'hbNewPassword'
		],
		'pluginOptions' => [
			'showMeter' => true,
			'toggleMask' => true
		]]); ?>

	<?= Html::tag('span', $repeatPasswordHelp, [
		'id' => 'hbNewPassword',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'language')->widget(Select2::class, [
		'data' => Language::getLanguageData(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbLanguage'
		]]) ?>

	<?= Html::tag('span', $languageHelp, [
		'id' => 'hbLanguage',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'status')->widget(Select2::class, [
		'data' => User::getStatusData(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbStatus'
		]]) ?>

	<?= Html::tag('span', $activeHelp, [
		'id' => 'hbStatus',
		'class' => 'help-block'
	]) ?>

	<br>
	
	<?php if (!$model->getIsNewRecord()) : ?>
		<?= Html::tag('span', Icon::show('user') . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
		<?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
	<?php endif; ?>

	<?= Html::tag('span', $mandatoryFields, [
		'class' => 'help-block'
	]) ?>

	<div class="form-group">
		<?= Html::submitButton($saveLabel, [
			'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
		]) ?>
		<?= Html::a($cancelLabel, $model->getIsNewRecord() ? ['index'] : [
			'view',
			'id' => $model->getAttribute('id')
		], [
			'class' => 'btn btn-danger'
		]) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
