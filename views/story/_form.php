<?php
/**
 * Displays the create page to Story CRUD.
 *
 * @var $this View
 * @var $model Story
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Epic;
use app\models\Feature;
use app\models\Product;
use app\models\Story;
use app\models\UserRole;
use kartik\depdrop\DepDrop;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$productIDHelp = Icon::show('info-circle') . Yii::t('story', 'Select the product of the story.');
$epicIDHelp = Icon::show('info-circle') . Yii::t('story', 'Select the epic of the story.');
$featureIDHelp = Icon::show('info-circle') . Yii::t('story', 'Select the feature of the story.');
$userRoleHelp = Icon::show('info-circle') . Yii::t('story', 'Select the user role of the story.');
$iWantToHelp = Icon::show('info-circle') . Yii::t('story', 'Describe the activity that the user want solve.');
$soThatHelp = Icon::show('info-circle') . Yii::t('story', 'Describe the business value of the activity.');
$saveLabel = Icon::show('download') . Yii::t('index', 'Save');
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
			'loadingText' => Yii::t('index', 'Loading...')
		]
	]) ?>

	<?= Html::tag('span', $epicIDHelp, [
		'id' => 'hbEpicID',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'feature_id')->widget(DepDrop::class, [
		'type' => DepDrop::TYPE_SELECT2,
		'data' => Feature::getFeatures($model->getAttribute('product_id'), $model->getAttribute('epic_id')),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbFeatureID',
			'id' => 'SelectFeatureID'
		],
		'pluginOptions' => [
			'depends' => ['SelectProductID', 'SelectEpicID'],
			'placeholder' => '---',
			'url' => Url::to(['feature/features']),
			'loadingText' => Yii::t('index', 'Loading...')
		]
	]) ?>

	<?= Html::tag('span', $featureIDHelp, [
		'id' => 'hbFeatureID',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'user_role_id')->widget(Select2::class, [
		'data' => UserRole::getUserRoles(),
		'options' => [
			'prompt' => '---',
			'aria-describedby' => 'hbUserRoleID'
		]]) ?>

	<?= Html::tag('span', $userRoleHelp, [
		'id' => 'hbUserRoleID',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'i_want_to')->textarea([
		'maxlength' => true,
		'rows' => '2',
		'aria-describedby' => 'hbIWantTo'
	]) ?>

	<?= Html::tag('span', $iWantToHelp, [
		'id' => 'hbIWantTo',
		'class' => 'help-block'
	]) ?>

	<?= $form->field($model, 'so_that')->textarea([
		'maxlength' => true,
		'rows' => '2',
		'aria-describedby' => 'hbSoThat'
	]) ?>

	<?= Html::tag('span', $soThatHelp, [
		'id' => 'hbSoThat',
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

	<?php $this->registerJs('$("#'. Html::getInputId($model, 'product_id') .'").select2("open");'); ?>

</div>
