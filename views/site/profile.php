<?php
/**
 * Displays the user profile page.
 *
 * @var $this View
 * @var $model User
 * @var $updated boolean
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Language;
use app\models\User;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('user', 'User profile');
$this->params['breadcrumbs'] = [[
		"label" => Yii::t('user', 'User profile'),
		"icon" => Icon::show('user'),
		"active" => false,
		"url" => Url::to(["site/profile"])
	]];

$usernameLabel = Icon::show('info-circle') . Yii::t('user', 'Input the username.');
$emailLabel = Icon::show('info-circle') . Yii::t('user', 'Input the e-mail address.');
$languageLabel = Icon::show('info-circle') . Yii::t('user', 'Input the language.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="user-profile">

	<div class="user-profile-form">

		<?php $form = ActiveForm::begin([
				'id' => 'user-profile-form',
			]); ?>

		<?php if ($model->hasErrors()) : ?>
			<div class="alert alert-danger">
				<?= $form->errorSummary($model) ?>
			</div>
		<?php endif; ?>

		<?php if ($updated) : ?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?= Yii::t('user', 'Data updated successfully.') ?>
			</div>
		<?php endif; ?>

		<?= $form->field($model, 'username')->textInput([
			'maxlength' => true, 
			'autofocus' => true, 
			'aria-describedby' => 'hbUsername'
		]) ?>
		
		<?= Html::tag('span', $usernameLabel, [
			'id' => 'hbUsername', 
			'class' => 'help-block'
		]) ?>

		<?= $form->field($model, 'email')->textInput([
			'maxlength' => true,
			'autofocus' => false,
			'aria-describedby' => 'hbEmail'
		]) ?>

		<?= Html::tag('span', $emailLabel, [
			'id' => 'hbEmail',
			'class' => 'help-block'
		]) ?>

		<?= $form->field($model, 'language')->widget(Select2::class, [
			'data' => Language::getLanguageData(), 
			'options' => [
				'prompt' => '---', 
				'aria-describedby' => 'hbLanguage'
			]]) ?>

		<?= Html::tag('span', $languageLabel, [
			'id' => 'hbLanguage',
			'class' => 'help-block'
		]) ?>
		
		<br>
		
		<?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), [
			'class' => 'help-block'
		]) ?>

		<?= Html::tag('span', $mandatoryFields, [
			'class' => 'help-block'
		]) ?>
		
		<div class="form-group">
			<?= Html::submitButton($saveLabel, ['class' => 'btn btn-success']) ?>
			<?= Html::a($cancelLabel, ['index'], ['class' => 'btn btn-danger']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

