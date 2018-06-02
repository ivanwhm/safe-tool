<?php
/**
 * Displays the update page to Product CRUD.
 *
 * @var $this View
 * @var $model Product
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Product;
use kartik\detail\DetailView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('product', 'View product');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('product', 'Products'),
		"icon" => Icon::show('product-hunt'),
		"url" => Url::to(["product/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('eye'),
		"url" => $model->getLink()
	]
];
?>

<div class="product-view">

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
				'confirm' => Yii::t('product', 'Do you want to delete this product?'),
				'method' => 'post'
			]
		]) ?>
	</p>

</div>
