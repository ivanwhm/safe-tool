<?php
/**
 * Displays the update page to Feature CRUD.
 *
 * @var $this View
 * @var $model Feature
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\components\SafeToolDetailView;
use app\models\enums\Icons;
use app\models\Feature;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('feature', 'View feature');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('feature', 'Features'),
		"icon" => Icons::getIcon(Icons::FEATURE),
		"url" => Url::to(["feature/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];

echo Html::beginTag('div', ['class' => 'feature-view']);

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
		'feature',
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
		'benefit_hypothesis',
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
]);

echo SafeToolDetailView::getCrudButtons($model, Yii::t('feature', 'Do you want to delete this feature?'));

echo Html::endTag('div');