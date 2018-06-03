<?php
/**
 * Displays the update page to Epic CRUD.
 *
 * @var $this View
 * @var $model Epic
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolDetailView;
use app\models\enums\Icons;
use app\models\Epic;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('epic', 'View epic');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('epic', 'Epics'),
		"icon" => Icons::getIcon(Icons::EPIC),
		"url" => Url::to(["epic/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];

echo Html::beginTag('div', ['class' => 'epic-view']);

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
		'title',
		[
			'attribute' => 'product_id',
			'format' => 'html',
			'value' => $model->getProduct()->printLink()
		],
		[
			'attribute' => 'type',
			'format' => 'html',
			'value' => $model->getType()
		],
		'epic',
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

echo SafeToolDetailView::getCrudButtons($model, Yii::t('epic', 'Do you want to delete this epic?'));

echo Html::endTag('div');