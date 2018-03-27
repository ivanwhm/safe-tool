<?php
/**
 * Displays the update page to ProductOwner CRUD.
 *
 * @var $this View
 * @var $model ProductOwner
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\ProductOwner;
use app\models\User;
use kartik\detail\DetailView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product-owner', 'View product owner');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('product-owner', 'Product owners'),
		"icon" => Icon::show('user-md'),
		"active" => false,
		"url" => Url::to(["product-owner/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('eye'),
		"active" => true,
		"url" => Url::to(["product-owner/view", 'id' => $model->getAttribute('id')])
	]
];
?>
<div class="product-owner-view">

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
				'confirm' => Yii::t('product-owner', 'Do you want to delete this product owner?'),
				'method' => 'post'
			]
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'name',
			[
				'attribute' => 'user_id',
				'format' => 'html',
				'value' => $model->getUser() instanceof User ? Html::a($model->getUser()->getAttribute('name'), $model->getUser()->getLink()) : ''
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
				'value' => $model->getUserCreated() instanceof User ? Html::a($model->getUserCreated()->getAttribute('name'), $model->getUserCreated()->getLink()) : ''
			],
			'date_updated:datetime',
			[
				'attribute' => 'user_updated',
				'format' => 'html',
				'value' => $model->getUserUpdated() instanceof User ? Html::a($model->getUserUpdated()->getAttribute('name'), $model->getUserUpdated()->getLink()) : ''
			],
		],
	]) ?>

</div>
