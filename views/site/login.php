<?php
/**
 * Displays the login page.
 *
 * @var $this View
 * @var $form ActiveForm
 * @var $model LoginForm;
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\forms\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

echo Html::beginTag('div', [
	'class' => 'col-md-4 col-md-offset-4'
]);

echo Html::beginTag('div', [
	'class' => 'login-panel logo-panel'
]);

if ($hasLogo && $logo != '') {
	echo Html::img($logo, ['alt' => 'logo']);
}

echo Html::endTag('div');

echo Html::beginTag('div', [
	'class' => 'panel panel-default'
]);

echo Html::beginTag('div', [
	'class' => 'panel-heading'
]);

echo Html::tag('h3', Yii::t('login', Yii::$app->name), [
	'class' => 'panel-title'
]);

echo Html::endTag('div');

echo Html::beginTag('div', [
	'class' => 'panel-body'
]);

$form = ActiveForm::begin(['id' => 'login-form']);

echo Html::beginTag('fieldset');

echo Html::beginTag('div', [
	'class' => 'form-group'
]);
echo $form->field($model, 'username')->textInput([
	'autofocus' => true,
	'placeholder' => true,
	'class' => 'form-control'
])->label(false);
echo Html::endTag('div');

echo Html::beginTag('div', [
	'class' => 'form-group'
]);
echo $form->field($model, 'password')->passwordInput([
	'placeholder' => true,
	'class' => 'form-control'
])->label(false);
echo Html::endTag('div');

echo Html::beginTag('div', [
	'class' => 'checkbox'
]);
echo $form->field($model, 'rememberMe')->checkbox();
echo Html::endTag('div');

echo Html::submitButton(Yii::t('login', 'Login'), [
	'class' => 'btn btn-lg btn-success btn-block',
	'name' => 'login-button'
]);

echo Html::endTag('fieldset');

ActiveForm::end();

echo Html::endTag('div');
echo Html::endTag('div');
echo Html::endTag('div');

