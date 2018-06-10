<?php
/**
 * Displays the create page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\ProductOwner;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'Add product owner');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('product-owner', 'Product owners'),
		"icon" => Icons::getIcon(Icons::PRODUCT_OWNER),
		"url" => Url::to(["product-owner/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

echo Html::beginTag('div', ['class' => 'product-owner-create']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
