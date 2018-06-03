<?php
/**
 * Displays the create page to Story CRUD.
 *
 * @var $this View
 * @var $model Story
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\Epic;
use app\models\Feature;
use app\models\Product;
use app\models\Story;
use app\models\StoryStatus;
use app\models\UserRole;
use kartik\depdrop\DepDrop;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

echo Html::beginTag('div', ['class' => 'story-form']);

$form = SafeToolActiveForm::begin(['id' => 'story-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'product_id')->widget(Select2::class, [
	'data' => Product::getProducts(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbProductID',
		'id' => 'SelectProductID'
	]
]);

echo $form->field($model, 'epic_id')->widget(DepDrop::class, [
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
]);

echo $form->field($model, 'feature_id')->widget(DepDrop::class, [
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
]);

echo $form->field($model, 'user_role_id')->widget(Select2::class, [
	'data' => UserRole::getUserRoles(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbUserRoleID'
	]
]);

echo $form->field($model, 'i_want_to')->textarea([
	'maxlength' => true,
	'rows' => '2',
	'aria-describedby' => 'hbIWantTo'
]);

echo $form->field($model, 'so_that')->textarea([
	'maxlength' => true,
	'rows' => '2',
	'aria-describedby' => 'hbSoThat'
]);

echo $form->field($model, 'priority')->widget(NumberControl::class, [
	'maskedInputOptions' => [
		'allowMinus' => false
	],
	'options' => [
		'aria-describedby' => 'hbPriorityID'
	]
]);

echo $form->field($model, 'story_status_id')->widget(Select2::class, [
	'data' => StoryStatus::getStoryStatuses(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbStoryStatusID'
	]
]);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model);
SafeToolActiveForm::end();

$this->registerJs('$("#' . Html::getInputId($model, 'product_id') . '").select2("open");');

echo Html::endTag('div');