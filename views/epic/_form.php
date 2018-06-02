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
use app\models\enums\Icons;
use app\models\Epic;
use app\models\Product;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$titleHelp =  Icons::getIcon(Icons::FORM_HELP) . Yii::t('epic', 'Input the title of the epic.');
$productHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('epic', 'Select the product of this epic.');
$typeHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('epic', 'Select the type of this epic.');
$epicHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('epic', 'Describe this epic.');
$saveLabel = Icons::getIcon(Icons::FORM_SAVE) . Yii::t('index', 'Save');
$cancelLabel = Icons::getIcon(Icons::FORM_CANCEL) . Yii::t('index', 'Cancel');
$mandatoryFields = Icons::getIcon(Icons::FORM_MANDATORY) . Yii::t('index', 'Fields marked with (*) are required.');

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

	<?= $form->field($model, 'product_id')->widget(Select2::class, [
		'data' => Product::getProducts(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbProduct'
		]]) ?>

	<?= Html::tag('span', $productHelp, [
		'id' => 'hbProduct',
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
			'view', 'id' => $model->getAttribute('id')], ['class' => 'btn btn-danger'
		]) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
