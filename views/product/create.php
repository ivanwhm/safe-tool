<?php
/**
 * Displays the create page to Product CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Product
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Add product');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('product', 'Products'),
		"icon" => Icons::getIcon(Icons::PRODUCT),
		"url" => Url::to(["product/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_ADD),
		"active" => false
	]
];

echo Html::beginTag('div', ['class' => 'product-create']);
echo $this->render('_form', ['model' => $model]);
echo Html::endTag('div');
