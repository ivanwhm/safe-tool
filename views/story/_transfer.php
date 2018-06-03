<?php
/**
 * Displays the product owner transfer of the Story CRUD.
 *
 * @var $this View
 * @var $model Story
 * @var $form SafeToolActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Icons;
use app\models\ProductOwner;
use app\models\Story;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;

$productOwnerIDHelp = Yii::t('story', 'Select the product owner of the story.');

echo Html::beginTag('div', ['class' => 'story-form']);

$form = SafeToolActiveForm::begin(['id' => 'story-form']);
echo $form->printErrorSummary($model);

echo $form->field($model, 'product_owner_id')->widget(Select2::class, [
	'data' => ProductOwner::getProductOwners(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbProductOwnerID'
	]
], $productOwnerIDHelp);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model);
echo $form->printFormButtons($model, Yii::t('index', 'Transfer'), Icons::FORM_TRANSFER);
SafeToolActiveForm::end();

$this->registerJs('$("#' . Html::getInputId($model, 'product_owner_id') . '").select2("open");');

echo Html::endTag('div');