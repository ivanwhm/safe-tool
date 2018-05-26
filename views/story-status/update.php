<?php
/**
 * Displays the update page to StoryStatus CRUD.
 *
 * @var $this View
 * @var $model StoryStatus
 *
 * @author Ivan Wilhelm <ivan.whm@icloud.com>
 */

//Imports
use app\models\StoryStatus;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('story-status', 'Update story status');
$this->params['breadcrumbs'] = [
	[
		"label" => Yii::t('index', 'Records'),
		"icon" => Icon::show('edit')
	],
	[
		"label" => Yii::t('story-status', 'Story statuses'),
		"icon" => Icon::show('tags'),
		"active" => false,
		"url" => Url::to(["story-status/index"])
	],
	[
		"label" => $this->title,
		"icon" => Icon::show('pencil'),
		"active" => true,
		"url" => $model->getLink(true)
	]
];
?>
<div class="story-status-update">

	<?= $this->render('_form', ['model' => $model]) ?>

</div>
