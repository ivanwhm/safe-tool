<?php
/**
 * Displays the create page to Story Role CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model StoryRole
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\StoryRole;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-role', 'Add story role');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('story-role', 'Story roles'),
		"icon" => Icon::show('female'),
		"active" => false,
		"url" => Url::to(["story-role/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('plus'),
		"active" => true
	]
];

?>
<div class="story-role-create">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
