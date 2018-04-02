<?php
/**
 * Displays the index page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel User
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\enums\Language;
use app\models\enums\Status;
use app\models\User;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('users'),
		"active" => true,
		"url" => Url::to(["user/index"])
	]
];
?>
<div class="user-index">

	<?= GridView::widget([
		'id' => 'user-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('users') . ' ' . Yii::t('user', 'Users') . '</h3>',
			'type' => GridView::TYPE_DEFAULT,
			'before' => Html::a(Icon::show('plus') . Yii::t('index', 'Add'), ['create'], ['class' => 'btn btn-success']),
			'after' => Html::a(Icon::show('refresh') . Yii::t('index', 'Reload'), ['index'], ['class' => 'btn btn-info']),
			'footer' => false
		],
		'columns' => [
			[
				'attribute' => 'id',
				'hAlign' => GridView::ALIGN_LEFT,
				'width' => '70px',
				'filter' => false
			],
			'name',
			'username',
			[
				'attribute' => 'status',
				'format' => 'html',
				'width' => '120px',
				'value' => function (User $data) {
					return $data->getStatus();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => Status::getData(),
				'filterWidgetOptions' => [
					'pluginOptions' => [
						'allowClear' => true
					],
				],
				'filterInputOptions' => [
					'placeholder' => '---'
				]
			],
			[
				'attribute' => 'language',
				'format' => 'html',
				'value' => function (User $data) {
					return $data->getLanguage();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => Language::getData(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],
			[
				'class' => ActionColumn::class,
				'template' => '{view} {update} {delete}',
				'buttons' => [
					'delete' => function ($url) {
						return Html::a(
							Icon::show('trash'),
							[$url],
							[
								'data-confirm' => Yii::t('user', 'Do you want to delete this user?'),
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
