<?php
/**
 * Displays the update page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $model StoryStatus
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\StoryStatus;
use kartik\detail\DetailView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'View story status');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('story-status', 'Story statuses'),
		"icon" => Icon::show('tags'),
		"active" => false,
		"url" => Url::to(["story-status/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('eye'),
		"active" => true,
		"url" => $model->getLink()
	]
];
?>

<div class="story-status-view">

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
			'name',
			[
				'attribute' => 'ready',
				'format' => 'html',
				'value' => $model->getReady()
			],
			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => $model->getStatus()
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
				'confirm' => Yii::t('story-status', 'Do you want to delete this story status?'),
				'method' => 'post'
			]
		]) ?>
	</p>

</div>
