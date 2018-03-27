<?php
/**
 * Displays the create page to Product Owner CRUD.
 *
 * @var $this View
 * @var $model ProductOwner
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Language;
use app\models\ProductOwner;
use app\models\User;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$productOwnerNameHelp = Icon::show('info-circle') . Yii::t('product-owner', 'Input the name of the product owner.');
$userIDHelp = Icon::show('info-circle') . Yii::t('product-owner', 'Select the user associated with this product owner.');
$activeHelp = Icon::show('info-circle') . Yii::t('product-owner', 'Please tell if the product owner is active or inactive.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
$cancelLabel = Icon::show('ban') . Yii::t('index', 'Cancel');
$mandatoryFields = Icon::show('asterisk') . Yii::t('index', 'Fields marked with (*) are required.');

?>

<div class="product-owner-form">

	<?php $form = ActiveForm::begin([
			'id' => 'product-owner-form',
		]
	); ?>

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

	<?= Html::tag('span', $productOwnerNameHelp, [
		'id' => 'hbName',
		'class' => 'help-block'
	]) ?>
	
	<?= $form->field($model, 'user_id')->widget(Select2::class, [
		'data' => User::getUsers(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbUserID'
		]]) ?>

	<?= Html::tag('span', $userIDHelp, [
		'id' => 'hbUserID',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'status')->widget(Select2::class, [
		'data' => ProductOwner::getStatusData(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbStatus'
		]]) ?>

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
