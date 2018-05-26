<?php
/**
 * Displays the create page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $model StoryStatus
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Status;
use app\models\enums\YesNo;
use app\models\StoryStatus;
use kartik\icons\Icon;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$nameHelp = Icon::show('info-circle') . Yii::t('story-status', 'Input the name of the story status.');
$readyHelp = Icon::show('info-circle') . Yii::t('story-status', 'Please tell if the ready property is yes or no.');
$activeHelp = Icon::show('info-circle') . Yii::t('story-status', 'Please tell if the story status is active or inactive.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="story-status-form">

	<?php $form = ActiveForm::begin(['id' => 'story-status-form']); ?>

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

	<?= Html::tag('span', $nameHelp, [
		'id' => 'hbName',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'ready')->widget(SwitchInput::class, [
		'type' => SwitchInput::CHECKBOX,
		'pluginOptions' => [
			'handleWidth' => 60,
			'onText' => YesNo::getStatusDescription(YesNo::YES),
			'offText' => YesNo::getStatusDescription(YesNo::NO),
			'onColor' => 'success',
			'offColor' => 'danger',
			'aria-describedby' => 'hbReady',
		]
	]); ?>

	<?= Html::tag('span', $readyHelp, [
		'id' => 'hbReady',
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
