<?php
/**
 * Displays the index page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
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

	<p>
		<?= Html::a(Icon::show('plus') . Yii::t('index', 'Add'), ['create'], [
			'class' => 'btn btn-success'
		]) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'pjax' => true,
		'columns' => [
			[
				'attribute' => 'id',
				'hAlign' => GridView::ALIGN_LEFT,
				'width' => '70px',
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
			],
			[
				'attribute' => 'language',
				'format' => 'html',
				'value' => function (User $data) {
					return $data->getLanguage();
				},
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
