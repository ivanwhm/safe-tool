<?php
/**
 * Displays the create page to Epic CRUD.
 *
 * @var $this View
 * @var $model Epic
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\EpicType;
use app\models\Epic;
use app\models\User;
use kartik\icons\Icon;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$titleHelp = Icon::show('info-circle') . Yii::t('epic', 'Input the title of the epic.');
$typeHelp = Icon::show('info-circle') . Yii::t('epic', 'Select the type of this epic.');
$epicHelp = Icon::show('info-circle') . Yii::t('epic', 'Describe this epic.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="epic-form">

	<?php $form = ActiveForm::begin(['id' => 'epic-form']); ?>

	<?php if ($model->hasErrors()) : ?>
		<div class="alert alert-danger">
			<?= $form->errorSummary($model) ?>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'title')->textInput([
		'maxlength' => true,
		'autofocus' => true,
		'aria-describedby' => 'hbTitle'
	]) ?>

	<?= Html::tag('span', $titleHelp, [
		'id' => 'hbTitle',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'type')->widget(Select2::class, [
		'data' => EpicType::getData(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbType'
		]]) ?>

	<?= Html::tag('span', $typeHelp, [
		'id' => 'hbType',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'epic')->textarea([
		'rows' => '10',
		'aria-describedby' => 'hbEpic'
	]) ?>

	<?= Html::tag('span', $epicHelp, [
		'id' => 'hbEpic',
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
