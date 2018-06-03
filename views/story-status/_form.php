<?php
/**
 * Displays the create page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $model StoryStatus
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Status;
use app\models\enums\YesNo;
use app\models\StoryStatus;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\web\View;

$nameHelp = Yii::t('story-status', 'Input the name of the story status.');
$readyHelp = Yii::t('story-status', 'Please tell if the ready property is yes or no.');
$activeHelp = Yii::t('story-status', 'Please tell if the story status is active or inactive.');

echo Html::beginTag('div', ['class' => 'story-status-form']);

$form = SafeToolActiveForm::begin(['id' => 'story-status-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'name')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbName'
], $nameHelp);

echo $form->field($model, 'ready')->widget(SwitchInput::class, [
	'type' => SwitchInput::CHECKBOX,
	'options' => [
		'aria-describedby' => 'hbReady'
	],
	'pluginOptions' => [
		'handleWidth' => 60,
		'onText' => YesNo::getStatusDescription(YesNo::YES),
		'offText' => YesNo::getStatusDescription(YesNo::NO),
		'onColor' => 'success',
		'offColor' => 'danger'
	]
], $readyHelp);

echo $form->field($model, 'status')->widget(SwitchInput::class, [
	'type' => SwitchInput::CHECKBOX,
	'options' => [
		'aria-describedby' => 'hbStatus'
	],
	'pluginOptions' => [
		'handleWidth' => 60,
		'onText' => Status::getStatusDescription(Status::ACTIVE),
		'offText' => Status::getStatusDescription(Status::INACTIVE),
		'onColor' => 'success',
		'offColor' => 'danger'
	]
], $activeHelp);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model);
SafeToolActiveForm::end();

echo Html::endTag('div');