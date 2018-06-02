<?php
/**
 * Displays the create page to StoryAcceptanceCriteria CRUD.
 *
 * @var $this View
 * @var $model StoryAcceptanceCriteria
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\StoryAcceptanceCriteria;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$acceptanceCriteriaHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('story-acceptance-criteria',
		'Describe the acceptance criteria of the story.');
$saveLabel = Icons::getIcon(Icons::FORM_SAVE) . Yii::t('index', 'Save');
$cancelLabel = Icons::getIcon(Icons::FORM_CANCEL) . Yii::t('index', 'Cancel');
$mandatoryFields = Icons::getIcon(Icons::FORM_MANDATORY) . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="story-form">

	<?php $form = ActiveForm::begin(['id' => 'story-form']); ?>

	<?php if ($model->hasErrors()) : ?>
		<div class="alert alert-danger">
			<?= $form->errorSummary($model) ?>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'acceptance_criteria')->textarea([
		'maxlength' => true,
		'autofocus' => true,
		'rows' => '4',
		'aria-describedby' => 'hbAcceptanceCriteria'
	]) ?>

	<?= Html::tag('span', $acceptanceCriteriaHelp, [
		'id' => 'hbAcceptanceCriteria',
		'class' => 'help-block'
	]) ?>

	<br>

	<?php if (!$model->getIsNewRecord()) : ?>
		<?= Html::tag('span', Icons::getIcon(Icons::FORM_USER) . $model->printCreatedInformation(), 
			['class' => 'help-block']) ?>
		<?= Html::tag('span', Icons::getIcon(Icons::FORM_USER) . $model->printLastUpdatedInformation(),
			['class' => 'help-block']) ?>
	<?php endif; ?>

	<?= Html::tag('span', $mandatoryFields, [
		'class' => 'help-block'
	]) ?>

	<div class="form-group">
		<?= Html::submitButton($saveLabel, [
			'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
		]) 
		?>
		
		<?= Html::a($cancelLabel, $model->getIsNewRecord() ? 
			['story/view', 'id' => $model->getAttribute('story_id')] : 
			['view', 'id' => $model->getAttribute('id')], 
			['class' => 'btn btn-danger']) 
		?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
