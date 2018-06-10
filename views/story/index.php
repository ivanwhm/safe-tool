<?php
/**
 * Displays the index page to Story CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel Story
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\Product;
use app\models\ProductOwner;
use app\models\Story;
use app\models\StoryStatus;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Stories');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => Url::to(["story/index"])
	]
];

echo Html::beginTag('div', ['class' => 'story-index']);
echo GridView::widget([
	'id' => 'story-gridview',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'pjax' => true,
	'hover' => true,
	'persistResize' => true,
	'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
	'panel' => [
		'heading' => ' <h3 class="panel-title">' . Icons::getIcon(Icons::STORY) . ' ' . Yii::t('story', 'Stories') . '</h3>',
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
		[
			'attribute' => 'product_owner_id',
			'format' => 'html',
			'width' => '170px',
			'value' => function (Story $data) {
				return $data->getProductOwner()->printLink();
			},
			'filterType' => GridView::FILTER_SELECT2,
			'filter' => ProductOwner::getProductOwners(),
			'filterWidgetOptions' => [
				'pluginOptions' => ['allowClear' => true],
			],
			'filterInputOptions' => ['placeholder' => '---']
		],
		[
			'attribute' => 'product_id',
			'format' => 'html',
			'width' => '170px',
			'value' => function (Story $data) {
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
			'value' => function (Story $data) {
				return $data->getEpic()->printLink();
			},
			'filter' => FALSE,
		],
		[
			'attribute' => 'feature_id',
			'format' => 'html',
			'width' => '170px',
			'value' => function (Story $data) {
				return $data->getFeature()->printLink();
			},
			'filter' => FALSE,
		],
		'priority',
		[
			'attribute' => 'story_status_id',
			'format' => 'html',
			'width' => '170px',
			'value' => function (Story $data) {
				return $data->getStoryStatus()->printLink();
			},
			'filterType' => GridView::FILTER_SELECT2,
			'filter' => StoryStatus::getStoryStatuses(),
			'filterWidgetOptions' => [
				'pluginOptions' => ['allowClear' => true],
			],
			'filterInputOptions' => ['placeholder' => '---']
		],
		[
			'class' => ActionColumn::class,
			'template' => '{view} {update} {transfer} {delete}',
			'buttons' => [
				'delete' => function ($url) {
					return Html::a(
						Icons::getIcon(Icons::CRUD_DELETE),
						[$url],
						[
							'data-confirm' => Yii::t('story', 'Do you want to delete this story?'),
							'data-method' => 'post'
						]
					);
				},
				'transfer' => function ($url) {
					return Html::a(
						Icons::getIcon(Icons::FORM_TRANSFER),
						[$url]
					);
				}
			]
		],
	],
]);
echo Html::endTag('div');
