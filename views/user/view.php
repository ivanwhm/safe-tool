<?php
/**
 * Displays the update page to User CRUD.
 *
 * @var $this View
 * @var $model User
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\User;
use kartik\detail\DetailView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'View user');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icon::show('user'),
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('eye'),
		"url" => $model->getLink()
	]
];
?>
<div class="user-view">
	
	<?= DetailView::widget([
		'model' => $model,
		'hover' => true,
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('eye') . ' ' . Yii::t('user', 'View user') . '</h3>',
			'type' => DetailView::TYPE_DEFAULT,
		],
		'buttons1' => '',
		'buttons2' => '',
		'attributes' => [
			'id',
			'name',
			'username',
			'email:email',
			[
				'attribute' => 'status',
				'format' => 'html',
				'value' => $model->getStatus()
			],
			[
				'attribute' => 'language',
				'format' => 'html',
				'value' => $model->getLanguage()
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
				'confirm' => Yii::t('user', 'Do you want to delete this user?'),
				'method' => 'post'
			]
		]) ?>
	</p>

</div>
