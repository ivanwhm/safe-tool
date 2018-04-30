<?php
/**
 * Displays the index page to Epic CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\EpicType;
use app\models\Epic;
use app\models\Product;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'Epics');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icon::show('globe'),
		"active" => true,
		"url" => Url::to(["epic/index"])
	]
];

?>
<div class="epic-index">

	<?= GridView::widget([
		'id' => 'epic-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('globe') . ' ' . Yii::t('epic', 'Epics') . '</h3>',
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
			'title',
			[
				'attribute' => 'product_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Epic $data) {
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
				'attribute' => 'type',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Epic $data) {
					return $data->getType();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => EpicType::getData(),
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
								'data-confirm' => Yii::t('epic', 'Do you want to delete this epic?'),
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
