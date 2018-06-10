<?php
/**
 * Displays the create page to Feature CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Feature
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Feature;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('feature', 'Add feature');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('feature', 'Features'),
		"icon" => Icons::getIcon(Icons::FEATURE),
		"url" => Url::to(["feature/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

echo Html::beginTag('div', ['class' => 'feature-create']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
