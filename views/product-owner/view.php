<?php
/**
 * Displays the update page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $model ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolDetailView;
use app\models\enums\Icons;
use app\models\ProductOwner;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'View product owner');
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
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];

echo Html::beginTag('div', ['class' => 'product-owner-view']);

echo DetailView::widget([
	'model' => $model,
	'hover' => true,
	'panel' => [
		'heading' => SafeToolDetailView::getDetailViewHeading($this->title),
		'type' => DetailView::TYPE_DEFAULT,
	],
	'buttons1' => '',
	'buttons2' => '',
	'attributes' => [
		'id',
		'name',
		[
			'attribute' => 'user_id',
			'format' => 'html',
			'value' => $model->printUserLink()
		],
		[
			'attribute' => 'status',
			'format' => 'html',
			'value' => $model->getStatus()
		],
		'date_created:datetime',
		[
			'attribute' => 'user_created',
			'format' => 'html',
			'value' => $model->printUserCreatedLink()
		],
		'date_updated:datetime',
		[
			'attribute' => 'user_updated',
			'format' => 'html',
			'value' => $model->printUserUpdatedLink()
		],
	],
]);

echo SafeToolDetailView::getCrudButtons($model, Yii::t('product-owner', 'Do you want to delete this product owner?'));

echo Html::endTag('div');