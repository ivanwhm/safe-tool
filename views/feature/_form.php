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
use app\models\enums\Icons;
use app\models\Epic;
use app\models\Feature;
use app\models\Product;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$featureHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('feature', 'Input the feature description.');
$productIDHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('feature', 'Select the product of the feature.');
$epicIDHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('feature', 'Select the epic of the feature.');
$benefitHypothesisHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('feature', 'Describe the benefit hypothesis for this feature.');
$acceptanceCriteriaHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('feature', 'Describe the acceptance criteria for this feature.');
$saveLabel = Icons::getIcon(Icons::FORM_SAVE) . Yii::t('index', 'Save');
$cancelLabel = Icons::getIcon(Icons::FORM_CANCEL) . Yii::t('index', 'Cancel');
$mandatoryFields = Icons::getIcon(Icons::FORM_MANDATORY) . Yii::t('index', 'Fields marked with (*) are required.');

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

	<?= $form->field($model, 'product_id')->widget(Select2::class, [
		'data' => Product::getProducts(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbProductID',
			'id' => 'SelectProductID'
		]]) ?>

	<?= Html::tag('span', $productIDHelp, [
		'id' => 'hbProductID',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'epic_id')->widget(DepDrop::class, [
		'type' => DepDrop::TYPE_SELECT2,
		'data' => Epic::getEpics($model->getAttribute('product_id')),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbEpicID',
			'id' => 'SelectEpicID'
		],
		'pluginOptions' => [
			'depends' => ['SelectProductID'],
			'placeholder' => '---',
			'url' => Url::to(['epic/epics']),
		]
	]) ?>

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
