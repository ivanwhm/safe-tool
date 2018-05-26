<?php
/**
 * Displays the index page to Story CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel Story
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\Product;
use app\models\Story;
use app\models\UserRole;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story', 'Stories');
$this->params['breadcrumbs'] = [
	[
		"label" => $this->title,
		"icon" => Icon::show('book'),
		"active" => true,
		"url" => Url::to(["story/index"])
	]
];

?>
<div class="story-index">

	<?= GridView::widget([
		'id' => 'story-gridview',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'pjax' => true,
		'hover' => true,
		'persistResize' => true,
		'resizeStorageKey' => Yii::$app->getUser()->getId() . '-' . date("m"),
		'panel' => [
			'heading' => ' <h3 class="panel-title">' . Icon::show('book') . ' ' . Yii::t('story', 'Stories') . '</h3>',
			'type' => 'default',
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
			[
				'attribute' => 'product_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Story $data) {
					return $data->getProduct()->printLink();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => Product::getProducts(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],
			[
				'attribute' => 'epic_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Story $data) {
					return $data->getEpic()->printLink();
				},
				'filter' => FALSE,
			],
			[
				'attribute' => 'feature_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Story $data) {
					return $data->getFeature()->printLink();
				},
				'filter' => FALSE,
			],
			[
				'attribute' => 'user_role_id',
				'format' => 'html',
				'width' => '170px',
				'value' => function (Story $data) {
					return $data->getUserRole()->printLink();
				},
				'filterType' => GridView::FILTER_SELECT2,
				'filter' => UserRole::getUserRoles(),
				'filterWidgetOptions' => [
					'pluginOptions' => ['allowClear' => true],
				],
				'filterInputOptions' => ['placeholder' => '---']
			],
			'i_want_to',
			[
				'class' => ActionColumn::class,
				'template' => '{view} {update} {delete}',
				'buttons' => [
					'delete' => function ($url) {
						return Html::a(
							Icon::show('trash'),
							[$url],
							[
								'data-confirm' => Yii::t('story', 'Do you want to delete this story?'),
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
