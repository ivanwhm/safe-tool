<?php
/**
 * Displays the index page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\ProductOwner;
use app\models\User;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'Product owners');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('user-md'),
		"active" => true,
		"url" => Url::to(["product-owner/index"])
	]
];

?>
<div class="product-owner-index">

	<?= GridView::widget([
		'id' => 'product-owner-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' =>' <h3 class="panel-title">' . Icon::show('user-md')  . ' '. Yii::t('product-owner', 'Product owners') .'</h3>',
			'type' => 'default',
			'before' => Html::a(Icon::show('plus') . Yii::t('index', 'Add'), ['create'], ['class' => 'btn btn-success']),
			'after' => Html::a(Icon::show('refresh') . Yii::t('index', 'Reload'), ['index'], ['class' => 'btn btn-info']),
			'footer'=> false
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
				'attribute' => 'user_id',
				'format' => 'html',
				'value' => function (ProductOwner $data) {
					return $data->printUserLink();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => User::getUsers(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],			
			[
				'attribute' => 'status',
				'format' => 'html',
				'width' => '120px',
				'value' => function (ProductOwner $data) {
					return $data->getStatus();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => ProductOwner::getStatusData(),
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
								'data-confirm' => Yii::t('product-owner', 'Do you want to delete this product owner?'), 
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