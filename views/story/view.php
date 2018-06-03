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
use app\components\SafeToolDetailView;
use app\models\enums\Icons;
use app\models\Story;
use app\models\StoryAcceptanceCriteria;
use kartik\detail\DetailView;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'View story');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'Stories'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => Url::to(["story/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];

echo Html::beginTag('div', ['class' => 'story-view']);

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
		[
			'attribute' => 'product_owner_id',
			'format' => 'html',
			'value' => $model->getProductOwner()->printLink()
		],
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
		'priority',
		[
			'attribute' => 'story_status_id',
			'format' => 'html',
			'value' => $model->getStoryStatus()->printLink()
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

echo SafeToolDetailView::getCrudButtons($model, Yii::t('story', 'Do you want to delete this story?'), 
	['create'], true);

echo Html::endTag('div');

echo Html::tag('br');

echo Html::beginTag('div', ['class' => 'story-view']);

echo GridView::widget([
	'id' => 'story-acceptance-criteria-gridview',
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'pjax' => true,
	'hover' => true,
	'persistResize' => true,
	'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
	'panel' => [
		'heading' => ' <h3 class="panel-title">' . Icons::getIcon(Icons::STORY_ACCEPTANCE_CRITERIA) . ' ' .
			Yii::t('story-acceptance-criteria', 'Acceptance criterias') . '</h3>',
		'type' => 'default',
		'before' => Html::a(Icons::getIcon(Icons::CRUD_ADD) . Yii::t('index', 'Add'),
			['story-acceptance-criteria/create', 'story' => $model->getAttribute('id')],
			['class' => 'btn btn-success']),
		'after' => Html::a(Icons::getIcon(Icons::CRUD_RELOAD) . Yii::t('index', 'Reload'),
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
						Icons::getIcon(Icons::CRUD_DELETE),
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

echo Html::endTag('div');
