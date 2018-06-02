<?php
/**
 * Displays the index page to Product CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Status;
use app\models\Product;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'Products');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icon::show('product-hunt'),
		"url" => Url::to(["product/index"])
	]
];

?>
<div class="product-index">

	<?= GridView::widget([
		'id' => 'product-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('product-hunt') . ' ' . Yii::t('product', 'Products') . '</h3>',
			'type' => 'default',
			'before' => Html::a(Icon::show('plus') . Yii::t('index', 'Add'), ['create'], ['class' => 'btn btn-success']),
			'after' => Html::a(Icon::show('refresh') . Yii::t('index', 'Reload'), ['index'], ['class' => 'btn btn-info']),
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
							Icon::show('trash'),
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

	?>

</div>
