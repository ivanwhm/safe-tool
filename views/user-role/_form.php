<?php
/**
 * Displays the create page to User Role CRUD.
 *
 * @var $this View
 * @var $model UserRole
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\enums\Status;
use app\models\UserRole;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$nameHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('user-role', 'Input the name of the user role.');
$descriptionHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('user-role', 'Input the description of the user role.');
$activeHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('user-role', 'Please tell if the user role is active or inactive.');
$saveLabel = Icons::getIcon(Icons::FORM_SAVE) . Yii::t('index', 'Save');
$cancelLabel = Icons::getIcon(Icons::FORM_CANCEL) . Yii::t('index', 'Cancel');
$mandatoryFields = Icons::getIcon(Icons::FORM_MANDATORY) . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="user-role-form">

	<?php $form = ActiveForm::begin(['id' => 'user-role-form']); ?>

	<?php if ($model->hasErrors()) : ?>
		<div class="alert alert-danger">
			<?= $form->errorSummary($model) ?>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'role')->textInput([
		'maxlength' => true,
		'autofocus' => true,
		'aria-describedby' => 'hbName'
	]) ?>

	<?= Html::tag('span', $nameHelp, [
		'id' => 'hbName',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'description')->textarea([
		'rows' => '3',
		'aria-describedby' => 'hbDescription'
	]) ?>

	<?= Html::tag('span', $descriptionHelp, [
		'id' => 'hbDescription',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'status')->widget(SwitchInput::class, [
		'type' => SwitchInput::CHECKBOX,
		'pluginOptions' => [
			'handleWidth' => 60,
			'onText' => Status::getStatusDescription(Status::ACTIVE),
			'offText' => Status::getStatusDescription(Status::INACTIVE),
			'onColor' => 'success',
			'offColor' => 'danger',
			'aria-describedby' => 'hbStatus',
		]
	]); ?>

	<?= Html::tag('span', $activeHelp, [
		'id' => 'hbStatus',
		'class' => 'help-block'
	]) ?>

	<br>

	<?php if (!$model->getIsNewRecord()) : ?>
		<?= Html::tag('span', Icons::getIcon(Icons::FORM_USER) . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
		<?= Html::tag('span', Icons::getIcon(Icons::FORM_USER) . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
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
