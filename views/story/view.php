<?php
/**
 * Displays the update page to Story CRUD.
 *
 * @var $this View
 * @var $model Story
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel StoryAcceptanceCriteria
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Story;
use app\models\StoryAcceptanceCriteria;
use kartik\detail\DetailView;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'View story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icon::show('book'),
		"active" => false,
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('eye'),
		"active" => true,
		"url" => $model->getLink()
	]
];
?>

<div class="story-view">

	<?= DetailView::widget([
		'model' => $model,
		'hover' => true,
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('eye') . ' ' . $this->title . '</h3>',
			'type' => DetailView::TYPE_DEFAULT,
		],
		'buttons1' => '',
		'buttons2' => '',
		'attributes' => [
			'id',
			[
				'attribute' => 'product_id',
				'format' => 'html',
				'value' => $model->getProduct()->printLink()
			],
			[
				'attribute' => 'epic_id',
				'format' => 'html',
				'value' => $model->getEpic()->printLink()
			],
			[
				'attribute' => 'feature_id',
				'format' => 'html',
				'value' => $model->getFeature()->printLink()
			],
			[
				'attribute' => 'user_role_id',
				'format' => 'html',
				'value' => $model->getUserRole()->printLink()
			],
			'i_want_to',
			'so_that',
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
	]) ?>

	<p>
		<?= Html::a(Icon::show('plus') . Yii::t('index', 'Add'), ['create'], [
			'class' => 'btn btn-success'
		]) ?>

		<?= Html::a(Icon::show('pencil') . Yii::t('index', 'Update'), [
			'update',
			'id' => $model->getAttribute('id')
		], [
			'class' => 'btn btn-primary'
		]) ?>

		<?= Html::a(Icon::show('trash') . Yii::t('index', 'Delete'), [
			'delete',
			'id' => $model->getAttribute('id')
		], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('story', 'Do you want to delete this story?'),
				'method' => 'post'
			]
		]) ?>
	</p>

</div>

<br>

<div class="story-acceptance-criteria-index">

	<?= GridView::widget([
		'id' => 'story-acceptance-criteria-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('check-circle') . ' ' . 
				Yii::t('story-acceptance-criteria', 'Acceptance criterias') . '</h3>',
			'type' => 'default',
			'before' => Html::a(Icon::show('plus') . Yii::t('index', 'Add'),
				['story-acceptance-criteria/create', 'story' => $model->getAttribute('id')], 
				['class' => 'btn btn-success']),
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
			'acceptance_criteria',
			[
				'class' => ActionColumn::class,
				'template' => '{view} {update} {delete}',
				'controller' => 'story-acceptance-criteria',
				'buttons' => [
					'delete' => function ($url) {
						return Html::a(
							Icon::show('trash'),
							[$url],
							[
								'data-confirm' => Yii::t('story-acceptance-criteria', 
									'Do you want to delete this acceptance criteria?'),
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