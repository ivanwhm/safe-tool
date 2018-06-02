<?php
/**
 * Displays the index page to Feature CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel Feature
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Feature;
use app\models\Product;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('feature', 'Features');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::FEATURE),
		"url" => Url::to(["feature/index"])
	]
];

?>
<div class="feature-index">

	<?= GridView::widget([
		'id' => 'feature-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icons::getIcon(Icons::FEATURE) . ' ' . Yii::t('feature', 'Features') . '</h3>',
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
			'feature',
			[
				'attribute' => 'product_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Feature $data) {
					return $data->getProduct()->printLink();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => Product::getProducts(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],			
			[
				'attribute' => 'epic_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Feature $data) {
					return $data->getEpic()->printLink();
				},
				'filter' => FALSE,
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
								'data-confirm' => Yii::t('feature', 'Do you want to delete this feature?'),
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
