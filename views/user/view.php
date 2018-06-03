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
use app\components\SafeToolDetailView;
use app\models\enums\Icons;
use app\models\User;
use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'View user');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"active" => false,
		"icon" => Icons::getIcon(Icons::RECORDS)
	],
	[
		"label" => Yii::t('user', 'Users'),
		"icon" => Icons::getIcon(Icons::FORM_USER),
		"url" => Url::to(["user/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icons::getIcon(Icons::CRUD_VIEW),
		"url" => $model->getLink()
	]
];

echo Html::beginTag('div', ['class' => 'user-view']);

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
]);

echo SafeToolDetailView::getCrudButtons($model, Yii::t('user', 'Do you want to delete this user?'));

echo Html::endTag('div');
