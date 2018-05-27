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
use app\models\ProductOwner;
use app\models\Story;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$productOwnerIDHelp = Icon::show('info-circle') . Yii::t('story', 'Select the product owner of the story.');
$transferLabel = Icon::show('exchange') . Yii::t('index', 'Transfer');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

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
		<?= Html::tag('span', Icon::show('user') . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
		<?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
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

</div>
