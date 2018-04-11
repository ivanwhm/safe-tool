<?php
/**
 * Displays the create page to Feature CRUD.
 *
 * @var $this View
 * @var $model Feature
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Epic;
use app\models\Feature;
use kartik\icons\Icon;
use \kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$featureHelp = Icon::show('info-circle') . Yii::t('feature', 'Input the feature description.');
$epicIDHelp = Icon::show('info-circle') . Yii::t('feature', 'Select the epic of the feature.');
$benefitHypothesisHelp = Icon::show('info-circle') . Yii::t('feature', 'Describe the benefit hypothesis for this feature.');
$acceptanceCriteriaHelp = Icon::show('info-circle') . Yii::t('feature', 'Describe the acceptance criteria for this feature.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="feature-form">

	<?php $form = ActiveForm::begin(['id' => 'feature-form']); ?>

	<?php if ($model->hasErrors()) : ?>
		<div class="alert alert-danger">
			<?= $form->errorSummary($model) ?>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'feature')->textInput([
		'maxlength' => true,
		'autofocus' => true,
		'aria-describedby' => 'hbFeature'
	]) ?>

	<?= Html::tag('span', $featureHelp, [
		'id' => 'hbFeature',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'epic_id')->widget(Select2::class, [
		'data' => Epic::getEpics(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbEpicID'
		]]) ?>

	<?= Html::tag('span', $epicIDHelp, [
		'id' => 'hbEpicID',
		'class' => 'help-block'
	]) ?>
	
	<?= $form->field($model, 'benefit_hypothesis')->textarea([
		'maxlength' => true,
		'rows' => '5',
		'aria-describedby' => 'hbBenefitHypothesis'
	]) ?>

	<?= Html::tag('span', $benefitHypothesisHelp, [
		'id' => 'hbBenefitHypothesis',
		'class' => 'help-block'
	]) ?>	
	
	<?= $form->field($model, 'acceptance_criteria')->textarea([
		'maxlength' => true,
		'rows' => '10',
		'aria-describedby' => 'hbAcceptanceCriteria'
	]) ?>

	<?= Html::tag('span', $acceptanceCriteriaHelp, [
		'id' => 'hbAcceptanceCriteria',
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
