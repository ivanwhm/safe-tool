<?php
/**
 * Displays the create page to StoryAcceptanceCriteria CRUD.
 *
 * @var $this View
 * @var $model StoryAcceptanceCriteria
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Icons;
use app\models\StoryAcceptanceCriteria;
use yii\helpers\Html;
use yii\web\View;

$acceptanceCriteriaHelp = Yii::t('story-acceptance-criteria', 'Describe the acceptance criteria of the story.');

echo Html::beginTag('div', ['class' => 'story-form']);

$form = SafeToolActiveForm::begin(['id' => 'story-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'acceptance_criteria')->textarea([
	'maxlength' => true,
	'autofocus' => true,
	'rows' => '4',
	'aria-describedby' => 'hbAcceptanceCriteria'
], $acceptanceCriteriaHelp);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model, Yii::t('index', 'Save'), Icons::FORM_SAVE,
	['story/view', 'id' => $model->getAttribute('story_id')]);
SafeToolActiveForm::end();

echo Html::endTag('div');