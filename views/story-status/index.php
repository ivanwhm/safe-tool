<?php
/**
 * Displays the index page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel StoryStatus
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Status;
use app\models\StoryStatus;
use app\models\enums\YesNo;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'Story statuses');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icon::show('edit')
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('tags'),
		"url" => Url::to(["story-status/index"])
	]
];

?>
<div class="story-status-index">

	<?= GridView::widget([
		'id' => 'story-status-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('tags') . ' ' . Yii::t('story-status', 
					'Story statuses') . '</h3>',
			'type' => 'default',
			'before' => Html::a(Icon::show('plus') . Yii::t('index', 'Add'), 
				['create'], ['class' => 'btn btn-success']),
			'after' => Html::a(Icon::show('refresh') . Yii::t('index', 'Reload'), 
				['index'], ['class' => 'btn btn-info']),
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
				'attribute' => 'ready',
				'format' => 'html',
				'width' => '120px',
				'value' => function (StoryStatus $data) {
					return $data->getReady();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => YesNo::getData(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],
			[
				'attribute' => 'status',
				'format' => 'html',
				'width' => '120px',
				'value' => function (StoryStatus $data) {
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
								'data-confirm' => Yii::t('story-status', 'Do you want to delete this story status?'),
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
