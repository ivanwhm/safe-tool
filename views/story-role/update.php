<?php
/**
 * Displays the update page to Story Role CRUD.
 *
 * @var $this View
 * @var $model StoryRole
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\StoryRole;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-role', 'Update story role');
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
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="story-role-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
