<?php
/**
 * Displays the user profile page.
 *
 * @var $this View
 * @var $model User
 * @var $updated boolean
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\components\SafeToolActiveForm;
use app\models\enums\Icons;
use app\models\enums\Language;
use app\models\User;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'User profile');
$this->params['breadcrumbs'] = [[
	"label" => Yii::t('user', 'User profile'),
	"icon" => Icons::getIcon(Icons::FORM_USER),
	"active" => false,
	"url" => Url::to(["site/profile"])
]];

echo Html::beginTag('div', ['class' => 'user-profile-form']);

$form = SafeToolActiveForm::begin(['id' => 'user-profile-form']);
echo $form->printErrorSummary($model);

if ($updated) {
	echo Html::beginTag('div', ['class' => 'alert alert-success alert-dismissable']);
	echo Html::button('&times;', [
		'class' => 'close',
		'data-dismiss' => 'alert',
		'aria-hidden' => 'true',
	]);
	echo Yii::t('user', 'Data updated successfully.');
	echo Html::endTag('div');
}

echo $form->field($model, 'username')->textInput([
	'maxlength' => true,
	'autofocus' => true,
	'aria-describedby' => 'hbUsername'
]);

echo $form->field($model, 'email')->textInput([
	'maxlength' => true,
	'autofocus' => false,
	'aria-describedby' => 'hbEmail'
]);

echo $form->field($model, 'language')->widget(Select2::class, [
	'data' => Language::getData(),
	'options' => [
		'prompt' => '---',
		'aria-describedby' => 'hbLanguage'
	]
]);

echo Html::tag('br');

echo $form->printMandatoryFieldsMessage();
echo $form->printModelDates($model, false);
echo $form->printFormButtons($model, Yii::t('index', 'Save'),
	Icons::FORM_SAVE, ['site/index'], ['site/index']);
SafeToolActiveForm::end();

echo Html::endTag('div');