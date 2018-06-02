<?php
/**
 * Displays the update page to StoryAcceptanceCriteria CRUD.
 *
 * @var $this View
 * @var $model StoryAcceptanceCriteria
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Icons;
use app\models\StoryAcceptanceCriteria;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-acceptance-criteria', 'View acceptance criteria');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('story', 'View story'),
		"icon" => Icons::getIcon(Icons::STORY),
		"url" => $model->getStory()->getLink()
	],
	[
		"label" => Yii::t('story-acceptance-criteria', 'Acceptance criterias'),
		"icon" => Icons::getIcon(Icons::STORY_ACCEPTANCE_CRITERIA),
		"url" => Url::to(['story/view', 'id' => $model->getAttribute('story_id')])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];
?>

<div class="story-acceptance-criteria-view">

	<?= DetailView::widget([
		'model' => $model,
		'hover' => true,
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icons::getIcon(Icons::CRUD_VIEW) . ' ' . $this->title . '</h3>',
			'type' => DetailView::TYPE_DEFAULT,
		],
		'buttons1' => '',
		'buttons2' => '',
		'attributes' => [
			'id',
			'acceptance_criteria',
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
		<?= Html::a(Icons::getIcon(Icons::CRUD_ADD) . Yii::t('index', 'Add'), 
			['story-acceptance-criteria/create', 'story' => $model->getAttribute('story_id')], 
			['class' => 'btn btn-success']
		) ?>

		<?= Html::a(Icons::getIcon(Icons::CRUD_EDIT) . Yii::t('index', 'Update'), [
			'update',
			'id' => $model->getAttribute('id')
		], [
			'class' => 'btn btn-primary'
		]) ?>

		<?= Html::a(Icons::getIcon(Icons::CRUD_DELETE) . Yii::t('index', 'Delete'), [
			'delete',
			'id' => $model->getAttribute('id')
		], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('story-acceptance-criteria', 
					'Do you want to delete this acceptance criteria?'),
				'method' => 'post'
			]
		]) ?>
	</p>

</div>
