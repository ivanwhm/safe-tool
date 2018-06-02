<?php
/**
 * Displays the product owner transfer of the Story CRUD.
 *
 * @var $this View
 * @var $model Story
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\ProductOwner;
use app\models\Story;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$productOwnerIDHelp = Icons::getIcon(Icons::FORM_HELP) . Yii::t('story', 'Select the product owner of the story.');
$transferLabel = Icons::getIcon(Icons::FORM_TRANSFER) . Yii::t('index', 'Transfer');
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

	<?= $form->field($model, 'product_owner_id')->widget(Select2::class, [
		'data' => ProductOwner::getProductOwners(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbProductOwnerID'
		]]) ?>

	<?= Html::tag('span', $productOwnerIDHelp, [
		'id' => 'hbProductOwnerID',
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
		<?= Html::submitButton($transferLabel, [
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
	
	<?php $this->registerJs('$("#'. Html::getInputId($model, 'product_owner_id') .'").select2("open");'); ?>
	
</div>
