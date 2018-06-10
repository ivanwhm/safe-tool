<?php
/**
 * Displays the index page to Product CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel ProductOwner
 * @var $error boolean
 * @var $errorMessage string
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolMessages;
use app\models\enums\Icons;
use app\models\enums\Status;
use app\models\Product;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Products');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::PRODUCT),
		"url" => Url::to(["product/index"])
	]
];

if ($error) {
	echo SafeToolMessages::printMessage('danger', $errorMessage);
}

echo Html::beginTag('div', ['class' => 'product-index']);
echo GridView::widget([
	'id' => 'product-gridview',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'pjax' => true,
	'hover' => true,
	'persistResize' => true,
	'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
	'panel' => [
		'heading' => ' <h3 class="panel-title">' . Icons::getIcon(Icons::PRODUCT) . ' ' . Yii::t('product', 'Products') . '</h3>',
		'type' => 'default',
		'before' => Html::a(Icons::getIcon(Icons::CRUD_ADD) . Yii::t('index', 'Add'), ['create'], ['class' => 'btn btn-success']),
		'after' => Html::a(Icons::getIcon(Icons::CRUD_RELOAD) . Yii::t('index', 'Reload'), ['index'], ['class' => 'btn btn-info']),
		'footer' => false
	],
	'columns' => [
		[
			'attribute' => 'id',
			'hAlign' => GridView::ALIGN_LEFT,
			'width' => '70px',
			'filter' => false
		],
		'name',
		[
			'attribute' => 'status',
			'format' => 'html',
			'width' => '120px',
			'value' => function (Product $data) {
				return $data->getStatus();
			},
			'filterType' => GridView::FILTER_SELECT2,
			'filter' => Status::getData(),
			'filterWidgetOptions' => [
				'pluginOptions' => ['allowClear' => true],
			],
			'filterInputOptions' => ['placeholder' => '---']
		],
		[
			'class' => ActionColumn::class,
			'template' => '{view} {update} {delete}',
			'buttons' => [
				'delete' => function ($url) {
					return Html::a(
						Icons::getIcon(Icons::CRUD_DELETE),
						[$url],
						[
							'data-confirm' => Yii::t('product', 'Do you want to delete this product?'),
							'data-method' => 'post'
						]
					);
				}
			]
		],
	],
]);
echo Html::endTag('div');